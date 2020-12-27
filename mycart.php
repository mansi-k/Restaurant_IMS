<?php include 'header.php' ?>
<?php
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$user_id = $_SESSION['user'];
?>
<body>
<?php include 'navbar.php'; ?>

<div class="large-content" id="mycart">
    <div class="overlay">
        <h1 class="strip-head"><img class="head-icon" src="images/icons/noticart.png"><br>Your Cart<br><img class="head-hr" src="images/icons/hr2.png"></h1>
        <div id="cartdiv">
            <?php
            $query1 = mysqli_query($bd,"SELECT * FROM cart INNER JOIN menu ON c_mid=m_id WHERE c_uid='$user_id'");
            if(mysqli_num_rows($query1)>0) {
                ?>
                <form id="cart-form" method="post" onsubmit="buycart()">
                    <table class="menutable">
                        <tr class="t-head1">
                            <th>Select</th>
                            <th>Menu Item</th>
                            <th>Qty</th>
                            <th>Price (Rs)</th>
                        </tr>
                        <?php
                        while ($row1 = mysqli_fetch_array($query1))
                        {
                            ?>
                            <tr id="<?php echo $row1['c_id']; ?>" class="c_row">
                                <td class="m_id" id="<?php echo $row1['m_id']; ?>">
                                <input type="checkbox" onclick="removefromcart(this)" name="<?php echo $row1['c_id']; ?>"
                                         value="<?php echo $row1['m_id']; ?>" checked></td>
                                <td>
                                    <h4><?php echo ucwords($row1['m_name']); ?></h4>
                                    <p><?php echo ucfirst($row1['m_desc']); ?></p>
                                </td>
                                <td><input class="cmqty" name="<?php echo $row1['m_price']; ?>" type="number" min="1"
                                           max="50" value="1" oninput="changeprice(this)"></td>
                                <td class="cmqp"><?php echo $row1['m_price']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr id="cartotle">
                            <td colspan="4"><h3>Total : Rs.<span id="rs">200</span></h3></td>
                        </tr>
                        <tr class="ctpay">
                            <td colspan="4">
                                <center>
                                    <div class="col-sm-7">
                                        <h3>Deliver to</h3>
                                        <div id="chaddr">
                                            <div>
                                                <input type="radio" name="adr" value="<?php echo $_SESSION['addr']; ?>"
                                                       checked onchange="addrchange(this)"> Your home address<br>
                                                <input id="tro" type="radio" name="adr" value=""
                                                       onchange="addrchange(this)"> Another address<br>
                                            </div>
                                            <div>
                                                <textarea id="dcaddr" readonly placeholder="Enter New Address"><?php echo $_SESSION['addr']; ?></textarea><br><br>
                                                <select class="seltown" id="cart_town" disabled>
                                                    <?php
                                                    $twq = mysqli_query($bd,'SELECT * FROM town ORDER BY t_id ASC');
                                                    while($twr = mysqli_fetch_array($twq))
                                                    {?>
                                                        <option value="<?php echo $twr['t_id']; ?>" <?php if($twr['t_id']==$_SESSION['town']) echo 'selected'; ?>>
                                                            <?php echo ucwords($twr['t_name']) ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <h3>Payment Options</h3>
                                        <input type="radio" name="cartpay" value="op" checked> Online Payment<br>
                                        <input type="radio" name="cartpay" value="cod"> Cash On Delivery<br><br>
                                    </div>
                                </center>
                            </td>
                        </tr>
                        <tr id="ftbuy">
                            <td colspan="4">
                                <center>
                                    <button type="submit" name="btn_cart" class="submit-btn">Buy Cart</button>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
            }
            else
            {?>
                <center>
                    <div class="emptyc">
                       <h2>Your cart is empty!</h2><br>
                       <button type="button" class="submit-btn" onclick="location.href='menu.php';">Add items to cart</button>
                    </div>
                </center>
            <?php
            }?>
        </div>
    </div>
</div>

<script>
    function removefromcart(cartrow)
    {
        var cid = cartrow.name;
        console.log(cid);
        if( !$(cartrow).prop('checked') )
        {
            $.ajax({
                type: 'POST',
                url: 'phpfunctions.php',
                data: {
                    'crmid': cid
                },
                success: function(rem) {
                    if(rem=="removed")
                    {
                        $(cartrow).parent().parent().remove();
                        changetotal();
                    }
                }
            });
        }
    }

    function changetotal()
    {
        var total=0;
        $('.cmqp').each(function() {
            total += parseInt($(this).text());
        })
        $('#rs').text(total);
        if(total==0)
        {
            $('#cartdiv').load(' #cartdiv');
        }
    }
    changetotal();

    function changeprice(obj)
    {
        var singlep = parseInt(obj.name);
        var qty = parseInt(obj.value);
        var price = singlep*qty;
        $(obj).parent().next().text(price);
        changetotal();
    }

    function addrchange(rb) {
        if( $(rb).prop('checked') )
        {
            $('#dcaddr').val(rb.value);
            if(rb.id=="tro") {
                $('#dcaddr').removeAttr('readonly');
                $('#cart_town').removeAttr('disabled');
            }
            else {
                $('#dcaddr').attr('readonly', 'true');
                $('#cart_town').attr('disabled','true');
            }
        }
    }

    var ciqty  = [];
    var cipri = [];

    function buycart() {
        ciqty = $('.cmqty').map(function(){
            return $(this).val()
        }).get();
        var jscqt = JSON.stringify(ciqty);
        cipri = $('.cmqp').map(function(){
            return $(this).text()
        }).get();
        var jscpr = JSON.stringify(cipri);
        console.log(cipri);
        var total = $('#rs').text();
        var addr = $('#dcaddr').val();
        var ct = $('#cart_town').val();
        var pay = $('input:radio[name="cartpay"]:checked').val();
        $.ajax({
            type: 'POST',
            url: 'phpfunctions.php',
            data: {
                'ciqty': jscqt,
                'cipri': jscpr,
                'ctotal': total,
                'addr': addr,
                'ctw': ct,
                'cpay': pay
            },
            success: function(msg) {
                window.location.href='myorders.php';
                alert(msg);
            }
        });
    }

</script>

<?php include 'footer.php'; ?>
</body>