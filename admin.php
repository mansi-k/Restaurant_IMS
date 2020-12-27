<?php
include "header.php";
include_once "dbconnect.php";
if(!isset($_SESSION['admin']))
    header("Location: adminlogin.php");
$admin_id = $_SESSION['admin'];
?>

<body class="adminpb">
    <?php include "adminbar.php"; ?>
    <div class="admin-content" id="adorder">
        <h1>Orders Panel</h1><br><br>
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#neworders">New Orders</a></li>
            <li><a data-toggle="tab" href="#seenorders">Accepted Orders</a></li>
        </ul>
        <div class="tab-content admintabs">
            <div id="neworders" class="tab-pane fade in active adminpane">
                <h3>New Orders</h3><br>
                <center>
                    <div id="a-new-bills">
                        <?php
                        $query1 = mysqli_query($bd,"SELECT * FROM bill WHERE b_delivery='' ORDER BY b_id DESC");
                            if(mysqli_num_rows($query1)>0)
                            {
                                while ($row1 = mysqli_fetch_array($query1))
                                {
                                    $bid = $row1['b_id'];
                                    $uid = $row1['b_uid'];
                                    ?>
                                    <table class="bigtable">
                                        <tr>
                                            <td class="bigtd">
                                                <table class="i-flex-bill adtable">
                                                    <tr class="t-head1">
                                                        <th>Bill ID : <?php echo $bid ?></th>
                                                        <th colspan="2"><?php echo $row1['b_date']; ?></th>
                                                    </tr>
                                                    <tr class="t-head2">
                                                        <th>Menu Item</th>
                                                        <th>Qty</th>
                                                        <th>Price (Rs)</th>
                                                    </tr>
                                                    <?php
                                                    $query2 = mysqli_query($bd,"SELECT * FROM orders INNER JOIN menu ON o_mid=m_id WHERE o_bid='$bid'");
                                                    if(mysqli_num_rows($query2)>0)
                                                    {
                                                        while ($row2 = mysqli_fetch_array($query2))
                                                        {?>
                                                            <tr class="t-content">
                                                                <td><?php echo ucwords($row2['m_name']); ?></td>
                                                                <td><?php echo $row2['o_quantity']; ?></td>
                                                                <td><?php echo $row2['o_price'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }?>
                                                    <tr class="t-foot1">
                                                        <td>Sum (Without taxes)</td>
                                                        <td></td>
                                                        <td><?php echo $row1['b_sum']; ?></td>
                                                    </tr>
                                                    <tr class="t-foot2">
                                                        <td colspan="3">Total (Inclusive of taxes) : Rs.<?php echo $row1['b_total']; ?></td>
                                                    </tr>
                                                    <tr class="t-foot2">
                                                        <td colspan="3">Status : <?php echo ucfirst($row1['b_status'])?><br></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="bigtd">
                                                <table>
                                                    <?php
                                                    $query3 = mysqli_query($bd,"SELECT * FROM users WHERE u_id='$uid'");
                                                    $row3 = mysqli_fetch_array($query3);
                                                    ?>
                                                    <tr class="t-foot2">
                                                        <td colspan="3">Name : <?php echo ucfirst($row3['u_fname']).' '.ucfirst($row3['u_lname']) ?><br></td>
                                                    </tr>
                                                    <tr class="t-foot2">
                                                        <td colspan="3">Phone No : <?php echo $row3['u_phone'] ?><br></td>
                                                    </tr>
                                                    <tr class="t-foot2">
                                                        <td colspan="3">Address :<br><?php echo ucfirst($row1['b_address'])?><br><br></td>
                                                    </tr>
                                                    <tr class="t-foot2">
                                                        <td colspan="3">
                                                            <button type="button" class="submit-btn" value="<?php echo $row1['b_id'] ?>" onclick="orderStatus1(this)">Accept</button><br>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </center>
            </div>
            <div id="seenorders" class="tab-pane fade adminpane">
                <h3>Accepted Orders</h3><br>
                <center>
                    <div id="a-seen-bills">
                        <?php
                        $query1 = mysqli_query($bd,"SELECT * FROM bill WHERE b_delivery='accepted' ORDER BY b_id DESC");
                        if(mysqli_num_rows($query1)>0)
                        {
                            while ($row1 = mysqli_fetch_array($query1))
                            {
                                $bid = $row1['b_id'];
                                $uid = $row1['b_uid'];
                                ?>
                                <table class="bigtable">
                                    <tr>
                                        <td class="bigtd">
                                            <table class="i-flex-bill adtable">
                                                <tr class="t-head1">
                                                    <th>Bill ID : <?php echo $bid ?></th>
                                                    <th colspan="2"><?php echo $row1['b_date']; ?></th>
                                                </tr>
                                                <tr class="t-head2">
                                                    <th>Menu Item</th>
                                                    <th>Qty</th>
                                                    <th>Price (Rs)</th>
                                                </tr>
                                                <?php
                                                $query2 = mysqli_query($bd,"SELECT * FROM orders INNER JOIN menu ON o_mid=m_id WHERE o_bid='$bid'");
                                                if(mysqli_num_rows($query2)>0)
                                                {
                                                    while ($row2 = mysqli_fetch_array($query2))
                                                    {?>
                                                        <tr class="t-content">
                                                            <td><?php echo ucwords($row2['m_name']); ?></td>
                                                            <td><?php echo $row2['o_quantity']; ?></td>
                                                            <td><?php echo $row2['o_price'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }?>
                                                <tr class="t-foot1">
                                                    <td>Sum (Without taxes)</td>
                                                    <td></td>
                                                    <td><?php echo $row1['b_sum']; ?></td>
                                                </tr>
                                                <tr class="t-foot2">
                                                    <td colspan="3">Total (Inclusive of taxes) : Rs.<?php echo $row1['b_total']; ?></td>
                                                </tr>
                                                <tr class="t-foot2">
                                                    <td colspan="3">Status : <?php echo ucfirst($row1['b_status'])?><br></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="bigtd">
                                            <table>
                                                <?php
                                                $query3 = mysqli_query($bd,"SELECT * FROM users WHERE u_id='$uid'");
                                                $row3 = mysqli_fetch_array($query3);
                                                ?>
                                                <tr class="t-foot2">
                                                    <td colspan="3">Name : <?php echo ucfirst($row3['u_fname']).' '.ucfirst($row3['u_lname']) ?><br></td>
                                                </tr>
                                                <tr class="t-foot2">
                                                    <td colspan="3">Phone No : <?php echo $row3['u_phone'] ?><br></td>
                                                </tr>
                                                <tr class="t-foot2">
                                                    <td colspan="3">Address :<br><?php echo ucfirst($row1['b_address'])?><br><br></td>
                                                </tr>
                                                <tr class="t-foot2">
                                                    <td colspan="3">
                                                        <button type="button" class="submit-btn" value="<?php echo $row1['b_id'] ?>" onclick="orderStatus2(this)">Delivered</button><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            setInterval(function(){
                $('#a-new-bills').load(document.URL +  ' #a-new-bills');
            }, 30000);
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        });

        function orderStatus1(bill) {
            var bid = $(bill).val();
            $.ajax({
                type: 'POST',
                url: 'phpfunctions.php',
                data: {
                    'abillid': bid
                },
                success: function(status) {
                    if(status=='success')
                    {
                        $(bill).closest(".bigtable").remove();
                        $('#a-seen-bills').load(document.URL +  ' #a-seen-bills');
                    }
                    else
                        alert("Failed");
                }
            });
        }

        function orderStatus2(bill) {
            var bid = $(bill).val();
            $.ajax({
                type: 'POST',
                url: 'phpfunctions.php',
                data: {
                    'dbillid': bid
                },
                success: function(status) {
                    if(status=='success')
                    {
                        $(bill).closest(".bigtable").remove();
                    }
                    else
                        alert("Failed");
                }
            });
        }
    </script>
    <br><br>
</body>

