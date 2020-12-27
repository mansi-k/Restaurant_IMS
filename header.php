<?php
ob_start();
session_start();
include_once 'dbconnect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1.0" charset="utf-8">
    <meta name="keywords" content="willson's kitchen, wilson's kitchen, wilson, willson, kitchen, wk, bon appetit, restaurant, hotel,
                food, food menu, wilson's kitchen belapur, willson's kitchen belapur, wilson's kitchen cbd,
                willson's kitchen cbd, wilson's kitchen nerul, willson's kitchen nerul, wilson's kitchen seawoods,
                willson's kitchen seawoods, wilson's kitchen navi mumbai, willson's kitchen navi mumbai,
                willson's kitchen mumbai, wilson's kitchen mumbai, hotels in mumbai, hotels in navi mumbai, hotels in cbd,
                hotels in belapur, hotels in nerul, hotels in seawoods, restaurants in mumbai, restaurants in navi mumbai,
                restaurants in nerul, restaurants in cbd belapur,  restaurants in seawoods, online food order,
                online food order in mumbai, online food order in navi mumbai, online food order in cbd belapur,
                online food order in nerul, online food order in seawoods, food delivery, Indian tit bits, gourmet snacks,
                affordable fine-dine restaurant, affordable fine-dine hotel, wiches, soups, salads, veggies,
                hormone-free chicken, fresh meals, snacks, fresh meat, foot cart, meal box, weight watcher's delight,
                healthy fast food, best restaurant, best hotel"/>
    <meta name="description" content="Willson's Kitchen (WK) is an affordable fine-dine restaurant that brings Mumbai's best cuisines from the kitchen right to your doorstep. ">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/component.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/jquery-3.2.1.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <script src="js/cbpGridGallery.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <title>Wilson's Kitchen</title>
    <script>
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

        function loadtowns(modalid)
        {
            if( $('#'+modalid+' .seltown').has('option').length == 0 ) {
                $.ajax({
                    type: 'POST',
                    url: 'phpfunctions.php',
                    data: {
                        'towns': modalid
                    },
                    dataType: 'json',
                    success: function (town) {
                        $.each(town, function (k, v) {
                            $('#' + modalid + ' .seltown').append($('<option>', {
                                value: v.t_id,
                                text: v.t_name
                            }));
                        });
                        if(modalid != 'lsmodal') {
                            $.ajax({
                                type: 'POST',
                                url: 'phpfunctions.php',
                                data: {
                                    'utown': modalid
                                },
                                success: function (tw) {
                                    $('#' + modalid + ' .seltown option[value=' + tw + ']').prop('selected', true);
                                }
                            });
                        }
                    }
                });
            }
            $('#' + modalid).css('display', 'block');
        }
    </script>
</head>


