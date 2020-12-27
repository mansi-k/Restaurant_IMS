<?php include 'header.php' ?>
<body class="adminpb">
<?php include 'adminbar.php';
if(!isset($_SESSION['admin']))
    header("Location: adminlogin.php");
$admin_id = $_SESSION['admin'];
?>

<div class="admin-content menu-all" id="admeditmenu">
    <h1>Menu Panel</h1><br><br>
        <div class="navbar-header" id="pill-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admenucats">
                <span><img src="images/da.png"></span>
            </button>
            <a class="navbar-brand" href="#" id="admenu-nav-head"></a>
        </div>
        <div class="collapse navbar-collapse" id="admenucats">
            <ul class="nav nav-pills nav-justified flex-container">
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
                <li class="flex-item">
                    <a data-toggle="pill" href="#addnew"><img src="images/icons/plus.png">Add New</a>
                </li>
            </ul>
        </div><br><br>
        <div class="tab-content" id="admenutab">
            <?php
            $ct=1;
            $menuct1 = mysqli_query($bd,"SELECT * FROM menu_category ORDER BY mc_id ASC");
            while($row1=mysqli_fetch_array($menuct1))
            {
                $mcid = $row1['mc_id'];
                ?>
                <div id="<?php echo preg_replace('/[^a-zA-Z0-9-_\.]/','',$row1['mc_name']);?>" class="tab-pane fade mctp <?php if($ct==1){ echo 'in active'; } ?>">
                    <ul class="nav nav-pills nav-justified nvpills">
                        <li class="active"><a data-toggle="pill" href="<?php echo '#aveg'.$mcid ?>">Veg</a></li>
                        <li><a data-toggle="pill" href="<?php echo '#anonveg'.$mcid ?>">Non Veg</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="<?php echo 'aveg'.$mcid ?>" class="tab-pane fade in active vntp">
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
                                    <tr id="<?php echo 'trdm'.$row2['m_id'] ?>">
                                        <td>
                                            <button type="button" class="crudbtn" onClick="updatemodal(this)" value="<?php echo $row2['m_id'] ?>"><img src="images/icons/edit.png"></button>
                                            <button type="button" class="crudbtn" name="<?php echo 'dm'.$row2['m_id'] ?>" value="<?php echo $row2['m_id'] ?>" onclick="confirmdelete(this)"><img src="images/icons/delete.png"></button>
                                        </td>
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
                        <div id="<?php echo 'anonveg'.$mcid ?>" class="tab-pane fade vntp">
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
                                    <tr id="<?php echo 'trdm'.$row2['m_id'] ?>">
                                        <td>
                                            <button type="button" class="crudbtn" onClick="updatemodal(this)" value="<?php echo $row2['m_id'] ?>"><img src="images/icons/edit.png"></button>
                                            <button type="button" class="crudbtn" name="<?php echo 'dm'.$row2['m_id'] ?>" value="<?php echo $row2['m_id'] ?>" onclick="confirmdelete(this)"><img src="images/icons/delete.png"></button>
                                        </td>
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
            <div id="addnew" class="tab-pane fade">
                <br><br>
                <?php include "addmenu.php"; ?>
            </div>
        </div>
    </div>
<script>
    $('#admenu-nav-head').html($('.nav-pills .active').text());

    $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
        var target = $(e.target).text();
        $('#admenu-nav-head').html(target);
    });

    function confirmdelete(mi)
    {
        var cd = confirm("Do you want to delete?");
        if(cd == true)
        {
            var mid = $(mi).val();
            //var tp1 = $(mi).parents('.vntp').first();
            var tp = $(mi).closest('tr');
            //var tp1 = $(mi).parent().parent().parent().parent().parent().attr('id');
            //var tp2 = $('#'+tp1).parent().parent().attr('id');
            $.ajax({
                type: 'POST',
                url: 'phpfunctions.php',
                data: {
                    'delmid': mid
                },
                success: function(resp) {
                    if(resp=="success")
                    {
                        $(tp).remove();
                        /*
                        $('#admeditmenu').load(document.URL +  ' #admeditmenu',function() {
                            $('#admenutab .tab-pane').removeClass("in active");
                            $('#'+tp1).addClass("in active");
                            $('#'+tp2).addClass("in active");
                        });
                        */
                    }
                }
            });
        }
    }
    function updatemodal(menu)
    {
        var mid = $(menu).val();
        $.ajax({
            method: 'POST',
            url: 'phpfunctions.php',
            data: {
                'upmid': mid
            },
            dataType: 'json',
            success: function(data) {
                $('#menumodal h3 #hmid').html(mid);
                $('#ipmid').val(mid);
                $('#em-name').val(data.name);
                $('#em-desc').val(data.desc);
                $('input:radio[name=vnradio][value='+data.vn+']').prop('checked',true);
                $('#em-price').val(data.pri);
                $('input:radio[name=spradio][value='+data.sp+']').prop('checked',true);
                $('#em-img').attr('src','images/menu_pics/'+data.img);

                $('#em-taste option[value='+data.taste+']').prop('selected',true);
                $.ajax({
                    method: 'POST',
                    url: 'phpfunctions.php',
                    data: {
                        mcats: 'mcats'
                    },
                    dataType: 'json',
                    success: function(cat) {
                        $.each(cat, function(k,v) {
                            $('#menumodal #mcsel').append($('<option>', {
                                value: k,
                                text : v
                            }));
                        });
                        $('#mcsel option[value='+data.cat+']').prop('selected',true);
                        $('#menumodal').css({'display':'block'});
                    }
                });
            }
        });
    }

    function replacesq(iptf)
    {
        iptf.value = iptf.value.replace(/'/g,"`");
        console.log('replaced');
    }

</script>
<?php include 'menumodal.php'; ?>
<br><br>
</body>