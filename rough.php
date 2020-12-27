<?php
include 'dbconnect.php';
$mid = 1;
$dq = mysqli_query($bd,"SELECT * FROM menu WHERE m_id='$mid'");
if($dq)
{
    $mr = mysqli_fetch_array($dq);
    $mda = array();

        $mda['name'] = $mr['m_name'];
        $mda['desc'] = $mr['desc'];
        $mda['nv'] = $mr['nveg'];
        $mda['pri'] = $mr['m_price'];
        $mda['cat'] = $mr['category'];
        $mda['sp'] = $mr['special'];
        $mda['img'] = $mr['image'];

    echo json_encode($mda);
}
?>