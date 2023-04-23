<?php session_start();
if ($_SESSION['adminexist'] == 0) {
    header('location:signin.php');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Shop Online</title>
</head>

<body>
    <center>
        <div class="main">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <h2>Add Product</h2>
                <img src="images/logo.png" alt="logo" name="logo" id="logo"><br>

                <input type="text" id="prodname" name="prodname" placeholder="product TITILE"><br>

                <input type="text" id="prodprice" name="prodprice" placeholder="product PRICE"><br>

                <input type="text" id="prodquantity" name="prodquantity" placeholder="product QUANTITY"><br>

                <!-- <input type="textarea" id="moredetails" name="moredetails" placeholder="product DESCRIPTION" ><br>  -->


                <input type="file" id="prodimage" name="prodimage"><br>
                <input type="file" id="prodimage" name="prodimage2"><br>
                <input type="file" id="prodimage" name="prodimage3"><br>
                <input type="file" id="prodimage" name="prodimage4"><br>

                <textarea name="moredetails" id="moredetails">Enter description here...</textarea><br>
                <!-- <label or="prodimage">Choose image</label> -->
                <button name="upload">Upload Product ✅</button><br>
                <a href="products.php">See all Products</a><br><br>
                <p>Developed by: HOSSAIN AHACHI, KAWTAR SABIR and JAMILA LAKHLIFI</p>

            </form>
        </div>
    </center>
</body>

</html>