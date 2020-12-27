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

<div class="large-content">
    <div class="overlay">
        <h1 class="strip-head"><img class="head-icon" src="images/icons/ord.png"><br>Your Orders<br><img class="head-hr" src="images/icons/hr2.png"></h1>
        <center>
        <div id="c-flex-bills" class="masonry">
            <?php
            $query1 = mysqli_query($bd,"SELECT * FROM bill WHERE b_uid='$user_id' ORDER BY b_id DESC");
            if(mysqli_num_rows($query1)>0)
            {
                while($row1=mysqli_fetch_array($query1))
                {
                    $bid = $row1['b_id'];
                    ?>
                    <div class="item">
                        <table class="i-flex-bill">
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
                            $query2 = mysqli_query($bd,"SELECT * FROM orders INNER JOIN menu ON o_mid=m_id WHERE o_uid='$user_id' AND o_bid='$bid'");
                            if(mysqli_num_rows($query2)>0)
                            {
                                while ($row2 = mysqli_fetch_array($query2))
                                {?>
                                    <tr class="t-content">
                                        <td><?php echo ucwords($row2['m_name']); ?></td>
                                        <td><?php echo $row2['o_quantity']; ?></td>
                                        <td><?php echo $row2['o_price']; ?></td>
                                    </tr>
                                <?php
                                }
                            }
                            else
                            {
                                echo '<tr class="t-content">Menu item may be deleted</tr>';
                            }
                            ?>
                            <tr class="t-foot1">
                                <td>Sum (Without taxes)</td>
                                <td></td>
                                <td><?php echo $row1['b_sum']; ?></td>
                            </tr>
                            <tr class="t-foot2">
                                <td colspan="3"><br>Total (Inclusive of taxes) : Rs.<?php echo $row1['b_total']; ?></td>
                            </tr>
                            <tr class="t-foot2">
                                <td colspan="3">Status : <?php echo ucfirst($row1['b_status']); if($row1['b_delivery']!='') echo ' / '.ucfirst($row1['b_delivery'])?><br><br></td>
                            </tr>
                        </table>
                    </div>
                <?php
                }
            }
            ?>
        </div>
        </center>
    </div>
</div>

<script>
    $('.masonry').masonry({
        itemSelector: '.item',
        columnWidth: 390,
        fitWidth: true
    });
</script>



<?php include 'footer.php'; ?>
</body>