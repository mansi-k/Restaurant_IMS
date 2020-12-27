<div class="container-fluid content-strip" id="about-us">
    <div class="row">
        <div class="col-md-6" id="about-pics">

        </div>
        <div class="col-md-6" id="about-info">
            <h1 class="strip-head"><img class="head-icon" src="images/icons/abt.png"><br>Our Story<br><img class="head-hr" src="images/icons/hr2.png"></h1>
            <p>
                Started in 2014, <a href="http://www.wilsonskitchen.co.in">Willson's Kitchen (WK)</a> brings Mumbai's best
                cuisines from the kitchen right to your doorstep.Through these years WK has been tremendous growth and
                an increasing customer base. <a href="http://www.wilsonskitchen.co.in">Willson's Kitchen</a> is
                your answer for wholesome meals and munchies. Pick from a wide menu of fresh meals, soups and salads,
                Indian tit bits, gourmet snacks, and a lot more. Enjoy the taste of the food made with freshest of ingredients
                and delivered/served to you in a state-of-art packaging/food joint. For ardent lovers of food,
                WK offers unique cuisine, an affordable fine-dine restaurant. WK offers a great eat-out experience and
                high scores on quality. WK has tried to bridge the gap in demand for fine-dine experiences and their accessibility.
                It connects some of the best cuisines with foodies in a convenient manner and at a price that is a fraction
                of the price at various fine-dinning restaurants. A poineer in healthy fast food. WK serves ups and wiches,
                soups, salads, veggies, and hormone-free chicken. Recently WK has added a lot of novel healthy options to their menus.
            </p><br>
        </div>
    </div>
</div>

<div class="container-fluid content-strip" id="menu-category">
    <div class="overlay">
        <h1 class="strip-head"><img class="head-icon" src="images/icons/feat.png"><br>Features<br><img class="head-hr" src="images/icons/hr2.png"></h1>
        <div class="row">
            <center>
            <div class="col-sm-6 col-md-3 mcategory">
                <div class="mc-icon"><span class="helper"></span><img src="images/icons/hot.png"></div>
                <h2>Fresh Meals & Snacks</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            <div class="col-sm-6 col-md-3 mcategory">
                <div class="mc-icon"><span class="helper"></span><img src="images/icons/sosa.png"></div>
                <h2>Soups & Salads</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            <div class="col-sm-6 col-md-3 mcategory">
                <div class="mc-icon"><span class="helper"></span><img src="images/icons/tit.png"></div>
                <h2>Indian Tit Bits</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            <div class="col-sm-6 col-md-3 mcategory">
                <div class="mc-icon"><span class="helper"></span><img src="images/icons/meat.png"></div>
                <h2>Fresh Meat</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            </center>
        </div>
    </div>
</div>

<div class="paradivr">
    <center>
	<h3>Willson's Kitchen is your answer for wholesome meals and munchies. Pick from a wide menu of fresh meals, soups and salads, Indian tit bits, gourmet snacks, and a lot more.</h3>
    <br>
    <a href="willson's%20kitchen%20menu%20card.pdf" target="_blank"><button class="btns">View Full Menu</button></a><br><br>
    </center>
</div>

<div class="container-fluid content-strip" id="featured">
    <div id="grid-gallery" class="grid-gallery">
        <h1 class="strip-head"><img class="head-icon" src="images/icons/feat.png"><br>Featured Dishes<br><img class="head-hr" src="images/icons/hr2.png"></h1>
        <section class="grid-wrap">
            <ul class="grid">
                <li class="grid-sizer"></li><!-- for Masonry column width -->
                <?php
                $spq = mysqli_query($bd,"SELECT * FROM menu INNER JOIN menu_special ON m_id=ms_mid");
                while($sqr=mysqli_fetch_array($spq))
                {?>
                    <li id="<?php echo 'splm'.$sqr['m_id'] ?>">
                        <figure>
                            <img src="images/menu_pics/<?php echo $sqr['ms_image'] ?>" alt="<?php echo $sqr['ms_image'] ?>"/>
                            <figcaption>
                                <h3><?php echo ucwords($sqr['m_name']) ?></h3>
                                <p><?php echo ucfirst($sqr['m_desc']) ?></p>
                            </figcaption>
                        </figure>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <figure>
                        <img src="images/menu_pics/vegmaxmeal.jpg" alt="Wilson's Kitchen Special Veg Meals">
                        <figcaption>
                            <h3>Veg Meals</h3>
                            <p>A healthy & delicious whole meal package for the hungry vegetarians</p>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="images/menu_pics/nonvegmeal.jpg" alt="Wilson's Kitchen Special Non-Veg Meals">
                        <figcaption>
                            <h3>Non-Veg Meals</h3>
                            <p>A healthy & delicious whole meal package for the hungry non-vegetarians</p>
                        </figcaption>
                    </figure>
                </li>
                <li>
                    <figure>
                        <img src="images/menu_pics/diet.jpg" alt="Wilson's Kitchen Special Diet Recipes">
                        <figcaption>
                            <h3>Weight Watcher's Delight</h3>
                            <p>Healthy & delicious diet recipes for the hungry weight conscious</p>
                        </figcaption>
                    </figure>
                </li>
            </ul>
        </section>
        <section class="slideshow">
            <ul>
                <?php
                $shpq = mysqli_query($bd,"SELECT * FROM menu INNER JOIN menu_special ON m_id=ms_mid");
                while($shpr=mysqli_fetch_array($shpq))
                {
                    ?>
                    <li id="<?php echo 'show'.$shpr['m_id'] ?>">
                        <figure>
                            <figcaption>
                                <h3><?php echo ucwords($shpr['m_name']) ?></h3>
                                <p><?php echo ucfirst($shpr['m_desc']) ?></p>
                            </figcaption>
                            <img src="images/menu_pics/<?php echo $shpr['ms_image'] ?>"  alt="<?php echo $shpr['ms_image'] ?>" />
                        </figure>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <figure>
                        <figcaption>
                            <h3>Veg Meals</h3>
                            <p>A healthy & delicious whole meal package for the hungry vegetarians</p>
                        </figcaption>
                        <img src="images/menu_pics/vegmaxmeal.jpg" alt="Wilson's Kitchen Special Veg Meals">
                    </figure>
                </li>
                <li>
                    <figure>
                        <figcaption>
                            <h3>Non-Veg Meals</h3>
                            <p>A healthy & delicious whole meal package for the hungry non-vegetarians</p>
                        </figcaption>
                        <img src="images/menu_pics/nonvegmeal.jpg" alt="Wilson's Kitchen Special Non-Veg Meals">
                    </figure>
                </li>
                <li>
                    <figure>
                        <figcaption>
                            <h3>Weight Watcher's Delight</h3>
                            <p>Healthy & delicious diet recipes for the hungry weight conscious</p>
                        </figcaption>
                        <img src="images/menu_pics/diet.jpg" alt="Wilson's Kitchen Special Diet Recipes">
                    </figure>
                </li>
            </ul>
            <nav>
                <span class="icon nav-prev"></span>
                <span class="icon nav-next"></span>
                <span class="icon nav-close"></span>
            </nav>
            <div class="info-keys icon">Navigate with arrow keys</div>
        </section><!-- // slideshow -->
    </div><!-- // grid-gallery -->
    <script>
        new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
    </script>
</div>

<div class="paradivr">
    <center>
		<h3> Enjoy the taste of the food made with freshest of ingredients and delivered/served to you in a state-of-art packaging/ food joint. WK offers unique cuisine, an affordable fine-dine restaurant.</h3>
        <br>
        <?php if(!isset($_SESSION['user'])) {
            ?>
            <button class="btns" type="button" onClick="loadtowns('lsmodal')">Order Now</button>
            <?php
        }
        else {
            ?>
            <a href="menu.php"><button class="btns" type="button">Order Now</button></a>
            <?php
        }
        ?><br><br>
    </center>
</div>

<div class="container-fluid content-strip" id="contact-us">
    <div class="overlay">
        <h1 class="strip-head"><img class="head-icon" src="images/icons/abt.png"><br>Contact Us<br><img class="head-hr" src="images/icons/hr2.png"></h1>
        <div class="row">
            <div class="col-sm-6">
                <table class="tinfo">
                    <tr class="contact-item">
                        <td><img src="images/addr.png"></td>
                        <td>Shop 82, Gautam Complex,<br>Sector 11, CBD-Belapur,<br>Navi Mumbai</td>
                    </tr>
                    <tr class="contact-item">
                        <td><img src="images/phone.png"></td>
                        <td>(022) 33126082</td>
                    </tr>
                    <tr class="contact-item">
                        <td><img src="images/phone.png"></td>
                        <td>(022) 25204540</td>
                    </tr>
                    <tr class="contact-item">
                        <td><img src="images/mail.png"></td>
                        <td>wilsonskitchen@gmail.com</td>
                    </tr>
                    <tr class="contact-item">
                        <td><img src="images/web.png"></td>
                        <td><a href="http://www.wilsonskitchen.co.in">wilsonskitchen.co.in</a></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <div id="googleMap" class="img-responsive" ></div>
            </div>
        </div>
    </div>
</div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBh0H8FRiuJit0131p-RvpyDsaOeKYZi8o"></script>
<script>
    myMap();
    var map;
    function myMap() {
        var myCenter = new google.maps.LatLng(19.016559, 73.043196);
        var mapCanvas = document.getElementById("googleMap");
        var mapOptions = {
            center: myCenter,
            zoom: 18
        };
        map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
            position: myCenter,
            icon: 'images/icons/locp.png',
            animation: google.maps.Animation.BOUNCE
        });

        marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', myMap);
    $(window).on('resize', function() {
        var currCenter = map.getCenter();
        google.maps.event.trigger(map, 'resize');
        map.setCenter(currCenter);
    });
</script>