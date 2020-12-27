<?php include 'header.php';
if(!isset($_SESSION['user']))
{
header("Location: index.php");
}
?>
<body onload="uncheckall()">
<?php include 'navbar.php'; ?>

<div class="large-content">
    <div class="overlay">
        <h1 class="strip-head"><img class="head-icon" src="images/icons/ord.png"><br>Our Menu<br><img class="head-hr" src="images/icons/hr2.png"></h1>
        <div class="container menu-all">
            <div class="navbar-header" id="pill-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu_cat_colps">
                    <span><img src="images/da.png"></span>
                </button>
                <a class="navbar-brand" href="#" id="menu-nav-head"></a>
            </div>
            <div class="collapse navbar-collapse" id="menu_cat_colps">
                <ul class="nav nav-pills nav-justified flex-container" id="mcnp">
                    <?php
                        $c=1;
                        $menucats = mysqli_query($bd,"SELECT * FROM menu_category ORDER BY mc_id ASC");
                        while($row=mysqli_fetch_array($menucats))
                        {?>
                            <li class="flex-item <?php if($c==1){ echo 'active'; } ?>">
                                <a data-toggle="pill" href="<?php echo '#'.preg_replace('/[^a-zA-Z0-9-_\.]/','',$row['mc_name']);?>"><?php echo ucwords($row['mc_name']) ?></a>
                            </li>
                            <?php $c++;
                        }
                    ?>
                </ul>
            </div><br><br>
            <div class="tab-content">
                <?php
                    $ct=1;
                    $menuct1 = mysqli_query($bd,"SELECT * FROM menu_category ORDER BY mc_id ASC");
                    while($row1=mysqli_fetch_array($menuct1))
                    {
                        $mcid = $row1['mc_id'];
                        ?>
                        <div id="<?php echo preg_replace('/[^a-zA-Z0-9-_\.]/','',$row1['mc_name']);?>" class="tab-pane fade <?php if($ct==1){ echo 'in active'; } ?>">
                            <ul class="nav nav-pills nav-justified nvpills">
                                <li class="active"><a data-toggle="pill" href="<?php echo '#veg'.$mcid ?>">Veg</a></li>
                                <li><a data-toggle="pill" href="<?php echo '#nonveg'.$mcid ?>">Non Veg</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="<?php echo 'veg'.$mcid ?>" class="tab-pane fade in active">
                                    <table class="menutable">
                                        <tr class="t-head1">
                                            <th>Select</th>
                                            <th>Menu Item</th>
                                            <th>Price (Rs)</th>
                                        </tr>
                                        <?php
                                        $menuct2 = mysqli_query($bd,"SELECT * FROM menu LEFT JOIN menu_special ON m_id=ms_mid WHERE m_cat='$mcid' AND m_nveg='veg' ORDER BY m_id ASC");
                                        while($row2=mysqli_fetch_array($menuct2))
                                        {?>
                                            <tr>
                                                <td><input name="<?php echo $row2['m_id']; ?>" type="checkbox" value="<?php echo $row2['m_name']; ?>" onchange="countcart(this)"></td>
                                                <td>
                                                    <h4>
                                                        <?php echo ucwords($row2['m_name']); ?>
                                                        <?php
                                                        if($row2['m_taste']=='spicy')
                                                            echo "<img src='images/icons/spicy.png' class='m-spl'>";
                                                        else if($row2['m_taste']=='extra-spicy')
                                                            echo "<img src='images/icons/extras.png' class='m-spl'>";
                                                        if($row2['ms_mid']!=NULL)
                                                            echo "<img src='images/icons/star.png' class='m-spl'>";
                                                        ?>
                                                    </h4>
                                                    <p><?php echo ucfirst($row2['m_desc']); ?></p>
                                                </td>
                                                <td><?php echo $row2['m_price']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div id="<?php echo 'nonveg'.$mcid ?>" class="tab-pane fade">
                                    <table class="menutable">
                                        <tr class="t-head1">
                                            <th>Select</th>
                                            <th>Menu Item</th>
                                            <th>Price (Rs)</th>
                                        </tr>
                                        <?php
                                        $menuct2 = mysqli_query($bd,"SELECT * FROM menu LEFT JOIN menu_special ON m_id=ms_mid WHERE m_cat='$mcid' AND m_nveg='non-veg' ORDER BY m_id ASC");
                                        while($row2=mysqli_fetch_array($menuct2))
                                        {?>
                                            <tr>
                                                <td><input name="<?php echo $row2['m_id']; ?>" type="checkbox" value="<?php echo $row2['m_name']; ?>" onchange="countcart(this)"></td>
                                                <td>
                                                    <h4>
                                                        <?php echo ucwords($row2['m_name']); ?>
                                                        <?php
                                                        if($row2['m_taste']=='spicy')
                                                            echo "<img src='images/icons/spicy.png' class='m-spl'>";
                                                        else if($row2['m_taste']=='extra-spicy')
                                                            echo "<img src='images/icons/extras.png' class='m-spl'>";
                                                        if($row2['ms_mid']!=NULL)
                                                            echo "<img src='images/icons/star.png' class='m-spl'>";
                                                        ?>
                                                    </h4>
                                                    <p><?php echo ucfirst($row2['m_desc']); ?></p>
                                                </td>
                                                <td><?php echo $row2['m_price']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php $ct++;
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="noticart"><a href="mycart.php" onclick="addtocart()"><img src="images/icons/noticart.png"><span>Add To Cart</span></a><span id="ncb" class="badge">0</span></div>
<script>
    $('#menu-nav-head').html($('#mcnp .active').text());

    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).text();
        $('#menu-nav-head').html(target);
    });

    var cmenu = [];

    function countcart(cb)
    {
        var d1 = cb.name;
        if( $(cb).is(':checked') )
            cmenu.push(d1);
        else
        {
            var index = cmenu.indexOf(d1);
            if (index > -1)
                cmenu.splice(index, 1);
        }
        showcount();
    }

    function showcount()
    {
        var chn = $(".menu-all :checkbox:checked").length;
        $('#ncb').html(chn);
    }

    function addtocart()
    {
        var jsoncmenu = JSON.stringify(cmenu);
        $.ajax({
            type: 'POST',
            url: 'phpfunctions.php',
            data: {
                'cmenu_id': jsoncmenu
            },
            success: function(count) {
                if(count=="success")
                {

                }
            }
        });
    }

    function uncheckall()
    {
        $('input:checkbox').removeAttr('checked');
        $.ajax({
            type: 'POST',
            url: 'phpfunctions.php',
            data: {
                'checkmid': 'checkmid'
            },
            dataType: 'json',
            success: function(cm) {
                /*var i;
                for(i=0;i<cm.length;i++)
                    $('input:checkbox #'+cm[i]).attr('checked','checked');*/
                $.each(cm, function(k,v) {
                    $('input:checkbox[name='+v+']').attr('checked','checked');
                    $('input:checkbox[name='+v+']').attr('disabled','disabled');
                });
                showcount();
            }
        });
    }
</script>
<?php include 'footer.php'; ?>
</body>