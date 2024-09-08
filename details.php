<?php

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
            <img src="img/baner.webp" style="height: 117px;">
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
                <div id="headline">
                    <div id="headline_content">
                        <b>Welcome Guest</b>
                        <b style="color:yellow;">Shopping cart:</b>
                        <span>- Items: - Price:</span>
                    </div>
                </div>
                <div id="product_box">
                    <?php 

                    if(isset($_GET['pro_id'])){

                    $product_id = $_GET['pro_id'];
                    
                    $get_products = "SELECT * from products where product_id='$product_id'";

                    $run_products = mysqli_query($con ,$get_products );

                    while($row_products=mysqli_fetch_array($run_products)){

                        $pro_id = $row_products['product_id'];
                        $pro_title = $row_products['product_title'];
                        $pro_cat = $row_products['cat_id'];
                        $pro_brand = $row_products['brand_id'];
                        $pro_desc = $row_products['product_desc'];
                        $pro_price = $row_products['product_price'];
                        $pro_image1 = $row_products['product_img1'];
                        $pro_image2 = $row_products['product_img2']; 
                        $pro_image3 = $row_products['product_img3'];
                        
                        echo "
                        <div id='single_product'>
                        <h3>$pro_title</h3>

                        <img src='admin_area/product_imgs/$pro_image1' width='180px' height='180px' />
                        <img src='admin_area/product_imgs/$pro_image2' width='230px' height='230px' />
                        <img src='admin_area/product_imgs/$pro_image3' width='250px' height='250px' /><br>

                        <p><b>Price: $$pro_price </b></p>
                        <p>$pro_desc</p>
                        
                        <a href='index.php' style= 'float:left;'>Go Back</a>
                        <a href='index.php?add_cart=$pro_id'><button style= 'float:right;'>Add to Cart</button></a>
                        
                        </div>
                        ";            
                        
                    } 
                } 
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