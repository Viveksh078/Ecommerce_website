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
                <?php cart(); ?>
                <div id="headline">
                    <div id="headline_content">
                        <b>Welcome Guest</b>
                        <b style="color:yellow;">Shopping cart:</b>
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

                

                <div>
                    
                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
                        <table width="750" align="center">
                            <tr align="center">
                               <td colspan="5"><h2>Create An Account</h2></td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer Name:</b></td>
                                <td><input type="text" name="c_name" required /></td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer Email:</b></td>
                                <td><input type="text" name="c_email" required /></td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer Password:</b></td>
                                <td><input type="password" name="c_pass" required /></td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer Country:</b></td>
                                <td>
                                    <select name="c_country">
                                        <option value="">Select a Country</option>
                                        <option>India</option>
                                        <option>Japan</option>
                                        <option>USA</option>
                                        <option>UK</option>
                                        <option>Pakistan</option>
                                        <option>Austrelia</option>
                                        <option>Iran</option>
                                        <option>Afganistan</option>
                                        <option>bangladesh</option>
                                        
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer City:</b></td>
                                <td><input type="text" name="c_city" required /></td>
                            </tr>
                            <tr>
                                <td align="right"><b>customer Mobile:</b></td>
                                <td><input type="text" name="c_contact" required /></td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer Address:</b></td>
                                <td><input type="text" name="c_address" required /></td>
                            </tr>

                            <tr>
                                <td align="right"><b>customer Image:</b></td>
                                <td><input type="file" name="c_image" required /></td>
                            </tr>

                            <tr align="center">
                                <td colspan="5"><input type="submit" name="register" value="Submit" /></td>
                            </tr>
                        </table>
                    </form>

                </div>
            </div>

        </div>
        <div class="footer">
            <h1 style="color: #000; padding-top: 30px; text-align: center;"> &copy; 2022 - by wwww.onlineustaad.com</h1>
        </div>
    </div>    
</body>
</html>
<?php

    if(isset($_POST['register'])){

        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['temp_name'];
        $c_ip = getRealIpAddr();


        $insert_customer = "INSERT INTO customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) VALUES (' $c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";

        $run_customer = mysqli_query($con ,$insert_customer);

        move_uploaded_file($c_image_tmp,"customers/customer_photos/$c_image");

        $sel_cart = "select * from cart where ip_add ='$c_ip'";

        $run_cart = mysqli_query($con, $sel_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if($check_cart>0){

            $_SESSION['customer_email']=$c_email;

            echo "<script>alert('Account created successfully, Thank you!')</script>";

            echo "<script>window.open('checkout.php','_self')</script>";

        }
        else{
            $_SESSION['customer_email']=$c_email;

            echo "<script>alert('Account created successfully, Thank you!')</script>";

            echo "<script>window.open('index.php','_self')</script>";
        }


    }

?>