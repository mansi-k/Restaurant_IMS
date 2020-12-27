<nav class="navbar navbar-default" id="myScrollspy" data-spy="affix">
    <div class="container-fluid navborder">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="logo">
                <a href="http://www.wilsonskitchen.co.in"><img src="images/wkl.jpeg" alt="Willson's Kitchen Logo"></a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#about-us">About Us</a></li>
                <li><a href="#menu-category">Menu</a></li>
                <li><a href="#contact-us">Contact Us</a></li>
                <?php if(!isset($_SESSION['user'])) {
                    ?>
                    <li id="login1"><a href="#login1" onClick="loadtowns('lsmodal')">Order Now</a></li>
                    <li id="login2"><a href="#login2" onClick="loadtowns('lsmodal')">
                            <span class="glyphicon glyphicon-user"></span> | <span class="glyphicon glyphicon-log-in"></span>
                        </a></li>
                    <?php
                }
                else
                {?>
                    <li><a href="menu.php">Order Now</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo ucwords($_SESSION['fn']) ?><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="mycart.php">My Cart</a></li>
                            <li><a href="myorders.php">My Orders</a></li>
                            <li id="#edit-profile"><a href="#edit-profile" onClick="loadtowns('epmodal')">Edit Profile</a></li>
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

<script>
    var nvtop = $('#above-nav').outerHeight();
    $('#myScrollspy').attr('data-offset-top',nvtop);
</script>