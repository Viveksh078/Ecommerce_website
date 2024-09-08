<?php
session_start();
include("includes/db.php");
include("function/functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css" media="all">
    <title>My Shop</title>
</head>
<body>
    
    <!--main container start-->
    <div class="main_wrapper">

        <div class="header_wrapper">
           <a href="index.php"> <img src="img/google.png" alt="logo"></a>
            <img src="img/baner.webp" style="height: 117px; width: 696px;">
        </div>
        <div id="navbar">
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Product</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <li><a href="user_register.php">Sign Up</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
                <li><a href="contact.php">Contact us</a></li>
            </ul>
            <div id="form">
                <form method="get" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search a Product" />
                    <input type="Submit" name="Search" value="Search"/>
                </form>
            </div>
        </div>
        <div class="content_wrapper">
            <div id="left_sidebar">
                <div id="sidebar_title">Categories</div>
                <ul id="cats">
                    <?php getCats(); ?>
                </ul> 
                <div id="sidebar_title">Brands</div>
                <ul id="cats">                
                    <?php getBrands(); ?>
                </ul>

            </div>
            <div id="right_contect">
                <?php cart(); ?>
                <div id="headline">
                    <div id="headline_content">
                        <?php
                        
                        
                        if(!isset($_SESSION['customer_email']))
                        {
                            echo "<b>Welcome Guest! </b> <b style='color:yellow'>Shopping Cart</b>";
                        }
                        else{

                            echo "<b>Welcome:" . "<span style='color:skyblue'>" . $_SESSION['customer_email'] . "</span>" . "</b>" . "</b> <b style='color:yellow'> Your Shopping Cart </b>";
                        }
                        ?>
                        <span>-Total Items: <?php items(); ?> -Total Price:<?php total_price(); ?>-<a href="cart.php" style="color:#FF0;">Go to Cart</a>
                        &nbsp;
                        <?php
                        if(!isset($_SESSION['customer_email'])){

                       echo "<a href='checkout.php' style='color:#F93;'>Login</a>";                        
                        }
                        else{
                            echo  "<a href='logout.php' style='color:#F93;'>Logout</a>";
                        }
                        ?>
                        </span>
                    </div>
                </div>

                

                <div id="product_box">
                    <?php 
                    
                    getPro();
                    getCatPro();
                    getBrandPro();
                     ?>
                </div>
            </div>

        </div>
        <div class="footer">
            <h1 style="color: #000; padding-top: 30px; text-align: center;"> &copy; 2022 - by wwww.onlineustaad.com</h1>
        </div>
    </div>    
</body>
</html>