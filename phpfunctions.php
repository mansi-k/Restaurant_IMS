<?php
ob_start();
session_start();
include_once 'dbconnect.php';

if(isset($_POST['btn_logout']))
{
    session_destroy();
    unset($_SESSION['user']);
    header("Location: index.php");
}

if(isset($_POST['user_email']))
{
    $emailId=$_POST['user_email'];
    $query=mysqli_query($bd,"SELECT * FROM users WHERE u_email='$emailId'");
    $resp='';
    if(mysqli_num_rows($query)>0)
    {
        $resp = "Email already exists!";
        print_r($resp) ;
    }
    else
    {
        $resp = "OK" ;
        print_r($resp);
    }
}

if(isset($_POST['cmenu_id']))
{
    $cmid = json_decode(stripslashes($_POST['cmenu_id']));
    $uid = $_SESSION['user'];
    foreach($cmid as $id)
    {
        $ciquery=mysqli_query($bd,"INSERT INTO cart VALUES('', '$uid', '$id')");
    }
    print_r('success');
}

if(isset($_POST['crmid']))
{
    $cartid=$_POST['crmid'];
    $crquery=mysqli_query($bd,"DELETE FROM cart WHERE c_id='$cartid'");
    $respo='';
    if($crquery)
    {
        $respo = "removed";
        print_r($respo) ;
    }
    else
    {
        $respo = "no" ;
        print_r($respo);
    }
}

if(isset($_POST['ciqty']) && isset($_POST['cipri']) && isset($_POST['ctotal']) && isset($_POST['addr']) && isset($_POST['cpay']) && isset($_POST['ctw']))
{
    $ciqty = json_decode(stripslashes($_POST['ciqty']));
    $cipri = json_decode(stripslashes($_POST['cipri']));
    $cprice = $_POST['ctotal'];
    $addr = $_POST['addr'];
    $cpay = $_POST['cpay'];
    $ctw = $_POST['ctw'];
    $uid = $_SESSION['user'];
    $ctotal = $cprice + round($cprice*0.05);
    $bid;
    if($cpay=="cod")
        $cpay="not-paid";
    else
        $cpay="paid";
    $query1 = mysqli_query($bd,"INSERT INTO bill VALUES('','$cprice','$ctotal',CURDATE(),'$uid','$addr','$ctw','$cpay','')");
    if($query1)
    {
        $bq = mysqli_query($bd,"SELECT * FROM bill WHERE b_total='$ctotal' AND b_date=CURDATE() AND b_uid='$uid'");
        $bqr = mysqli_fetch_array($bq);
        $bid = $bqr['b_id'];
        $query2 = mysqli_query($bd,"SELECT * FROM cart WHERE c_uid='$uid'");
        if(mysqli_num_rows($query2)>0)
        {
            $i=0;
            while($row = mysqli_fetch_array($query2))
            {
                $ci = $row['c_id'];
                $mi = $row['c_mid'];
                $ciq = $ciqty[$i];
                $cip = $cipri[$i];
                $query3 = mysqli_query($bd,"INSERT INTO orders VALUES('','$uid','$mi','$ciq','$cip','$bid')");
                if($query3)
                {
                    $query4 = mysqli_query($bd,"DELETE FROM cart WHERE c_id='$ci'");
                }
                $i++;
            }
        }
        print_r("Ordered Successfully");
    }
    else print_r("Not Ordered");
}

if(isset($_POST['abillid']))
{
    $bid = $_POST['abillid'];
    $q = mysqli_query($bd,"UPDATE bill SET b_delivery='accepted' WHERE b_id='$bid'");
    if($q)
        print_r("success");
    else
        print_r("fail");
}

if(isset($_POST['dbillid']))
{
    $bid = $_POST['dbillid'];
    $q = mysqli_query($bd,"UPDATE bill SET b_delivery='delivered', b_status='paid' WHERE b_id='$bid'");
    if($q)
        print_r("success");
    else
        print_r("fail");
}

if(isset($_POST['delmid']))
{
    $mid = $_POST['delmid'];
    $dq = mysqli_query($bd,"DELETE FROM menu WHERE m_id='$mid'");
    if($dq)
        print_r("success");
    else
        print_r("fail");
}

if(isset($_POST['upmid']))
{
    $mid = $_POST['upmid'];
    $dq = mysqli_query($bd,"SELECT * FROM menu LEFT JOIN menu_special ON m_id=ms_mid WHERE m_id='$mid'");
    if($dq)
    {
        $mr = mysqli_fetch_array($dq);
        $mda = array();
        $mda['name'] = $mr['m_name'];
        $mda['desc'] = $mr['m_desc'];
        $mda['vn'] = $mr['m_nveg'];
        $mda['pri'] = $mr['m_price'];
        $mda['cat'] = $mr['m_cat'];
        if($mr['ms_mid']!=NULL || $mr['ms_mid']!='')
        {
            $mda['sp'] = 'yes';
            $mda['img'] = $mr['ms_image'];
        }
        else
        {
            $mda['sp'] = 'no';
            $mda['img'] = '';
        }
        if($mr['m_taste'] == '')
            $mda['taste'] = 0;
        else
            $mda['taste'] = $mr['m_taste'];
        echo json_encode($mda);
    }
}

if(isset($_POST['mcats']))
{
    $cq = mysqli_query($bd,"SELECT * FROM menu_category ORDER BY mc_id ASC");
    while($cqr = mysqli_fetch_array($cq))
    {
        $cqa[$cqr['mc_id']] = $cqr['mc_name'];
    }
    echo json_encode($cqa);
}

if(isset($_POST['towns']))
{
    $tq = mysqli_query($bd,"SELECT * FROM town ORDER BY t_id ASC");
    $tar = array();
    $i=0;
    while($tqr = mysqli_fetch_array($tq))
    {
        $tar[$i]['t_id'] = $tqr['t_id'];
        $tar[$i]['t_name'] = ucwords($tqr['t_name']);
        $i++;
    }
    echo json_encode($tar);
}

if(isset($_POST['utown']))
{
    $uid=$_SESSION['user'];
    $utq = mysqli_query($bd,"SELECT u_tid FROM users WHERE u_id='$uid'");
    $ut = mysqli_fetch_array($utq);
    print_r($ut['u_tid']);
}

if(isset($_POST['checkmid']))
{
    $uid=$_SESSION['user'];
    $i=0;
    $cma = array();
    $cmidq = mysqli_query($bd,"SELECT c_mid FROM cart WHERE c_uid='$uid'");
    while($cmr = mysqli_fetch_array($cmidq))
    {
        $cma[$i] = $cmr['c_mid'];
        $i++;
    }
    echo json_encode($cma);
}
