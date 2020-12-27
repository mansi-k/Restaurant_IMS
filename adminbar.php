<?php
if(isset($_POST['adbtn_logout']))
{
    session_destroy();
    unset($_SESSION['admin']);
    header("Location: adminlogin.php");
}
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="logo">
                <a href="index.php"><img src="images/wkl.jpeg"></a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="admNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if(basename($_SERVER['REQUEST_URI'])=="admin.php") echo "class='active'"; else echo "class=''"; ?>><a href="admin.php">Orders</a></li>
                <li <?php if(basename($_SERVER['REQUEST_URI'])=="adminmenu.php") echo "class='active'"; else echo "class=''"; ?>><a href="adminmenu.php">Menu</a></li>
                <li <?php if(basename($_SERVER['REQUEST_URI'])=="orderhistory.php") echo "class='active'"; else echo "class=''"; ?>><a href="orderhistory.php">History</a></li>
                <li>
                    <form method="post">
                        <button type="submit" name="adbtn_logout" class="submit-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


