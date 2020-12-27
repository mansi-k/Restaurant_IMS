<?php
ob_start();
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1.0" charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/jquery-3.2.1.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Wilson's Kitchen</title>
    <script type="text/javascript">
        function pswdshow(a,b)
        {
            if($(b).attr('type')=='password') {
                $(b).attr('type', 'text');
                $(a).attr('src', 'images/icons/pshow.png');
            }
            else {
                $(b).attr('type', 'password');
                $(a).attr('src', 'images/icons/phide.png');
            }
        }
    </script>
</head>
