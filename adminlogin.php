<?php
include 'header.php';
if((isset($_POST['adbtn_login'])))
{
    $login_id = $_POST['a-name'];
    $password = $_POST['a-pswd'];
    $epsw = md5($password);
    $res=mysqli_query($bd,"SELECT * FROM admin WHERE a_name='$login_id' and a_pswd='$epsw'");
    $row=mysqli_fetch_array($res);
    $p = $row['a_pswd'];
    if($row['a_pswd'] == $epsw )
    {
        $_SESSION['admin'] = $row['a_id'];
        $_SESSION['aname'] = $row['a_name'];
        header("Location: admin.php");
    }
    else
    {?>
        <script>
            window.alert("Unsuccessful");
            window.location.href="admin.php";
        </script>
        <?php
    }
}
?>
<body class="adminpb">
<div id="admin-lg">
    <div class="formborder">
        <h3>Admin Login</h3><br>
        <form class="user-form" id="adlogin-form" method="post">
            <label>Username</label><br>
            <input name="a-name" class="form-control" placeholder="Username" type="text"><br><br>
            <label>Password</label>
            <img src="images/icons/phide.png" class="pswshow" onclick="pswdshow(this,'#alogpw')"><br>
            <input id="alogpw" name="a-pswd" class="form-control" placeholder="Password" type="password"><br><br>
            <center>
                <button type="submit" class="submit-btn" name="adbtn_login">Login</button>
            </center>
        </form>
    </div>
</div>
<br><br>
</body>