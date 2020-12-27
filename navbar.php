<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid navborder">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="logo">
                <a href="http://www.wilsonskitchen.co.in"><img src="images/wkl.jpeg"></a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php#about-us">About Us</a></li>
                <li><a href="index.php#menu-category">Menu</a></li>
                <li><a href="index.php#contact-us">Contact Us</a></li>
                <?php if(!isset($_SESSION['user'])) {
                    ?>
                    <li><a href="#" onClick="loadtowns('lsmodal')">Order Now</a></li>
                    <li><a href="#" onClick="loadtowns('lsmodal')">
                        <span class="glyphicon glyphicon-user"></span> | <span class="glyphicon glyphicon-log-in"></span>
                    </a></li>
                    <?php
                }
                else
                {?>
                    <li <?php if(basename($_SERVER['REQUEST_URI'])=="menu.php") echo "class='active'"; else echo "class=''"; ?>><a href="menu.php">Order Now</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo ucwords($_SESSION['fn']) ?><span class="caret"></span>

                        </a>
                        <ul class="dropdown-menu">
                            <li <?php if(basename($_SERVER['REQUEST_URI'])=="mycart.php") echo "class='active'"; else echo "class=''"; ?>><a href="mycart.php">My Cart</a></li>
                            <li <?php if(basename($_SERVER['REQUEST_URI'])=="myorders.php") echo "class='active'"; else echo "class=''"; ?>><a href="myorders.php">My Orders</a></li>
                            <li id="editprofile"><a href="#editprofile" onClick="loadtowns('epmodal')">Edit Profile</a></li>
                            <li>
                                <form method="post" action="phpfunctions.php">
                                    <button class="dbtn" name="btn_logout">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <?php
                }?>
            </ul>
        </div>
    </div>
</nav>

<?php include 'lsmodal.php'; ?>
<?php include 'epmodal.php'; ?>

