<?php
$query1 = mysqli_query($bd,"SELECT * FROM bill WHERE b_delivery='' ORDER BY b_id DESC");
if(mysqli_num_rows($query1)>0)
{
    while($row1=mysqli_fetch_array($query1))
    {
        $bid = $row1['b_id'];
        ?>
        <div class="item">
            <table class="i-flex-bill adtable" id="<?php echo 'newo'.$row1['b_id'] ?>">
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
                $query2 = mysqli_query($bd,"SELECT * FROM orders INNER JOIN menu ON o_mid=m_id AND o_bid='$bid'");
                if(mysqli_num_rows($query2)>0)
                {
                    while ($row2 = mysqli_fetch_array($query2))
                    {?>
                        <tr class="t-content">
                            <td><?php echo $row2['m_name']; ?></td>
                            <td><?php echo $row2['quantity']; ?></td>
                            <td><?php echo $row2['qprice'] ?></td>
                        </tr>
                        <?php
                    }
                }?>
                <tr class="t-foot1">
                    <td>Sum (Without taxes)</td>
                    <td></td>
                    <td><?php echo $row1['b_price']; ?></td>
                </tr>
                <tr class="t-foot2">
                    <td colspan="3"><br>Total (Inclusive of taxes) : Rs.<?php echo $row1['b_total']; ?></td>
                </tr>
                <tr class="t-foot2">
                    <td colspan="3">Status : <?php echo ucfirst($row1['b_status'])?><br></td>
                </tr>
                <tr class="t-foot2">
                    <td colspan="3">Address : <?php echo ucfirst($row1['b_addr'])?><br><br></td>
                </tr>
                <tr class="t-foot2">
                    <td colspan="3">
                        <button type="button" class="submit-btn" value="<?php echo $row1['b_id'] ?>" onclick="orderStatus1(this)">Accept</button><br><br>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }
}
?>