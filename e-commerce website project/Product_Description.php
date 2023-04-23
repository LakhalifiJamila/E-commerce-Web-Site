<!-- include('connect.php');
$ins=$conn->prepare('SELECT * FROM product WHERE path='img/laptop1/biege.jpg' ');
$ins->execute(); -->
<?php session_start();
if ($_SESSION['exist'] == 0) {
    header('location:signin.php');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Product_Description.css">
    <script type="text/javascript" src="myscripts.js"></script>
    <title>Product Description</title>
</head>

<body>
    <?php include_once('header.php'); ?>



    <!-- base donnee -->
    <?php

    $id = (int)$_GET['id'];
    $extension = $_GET['Extension'];
    include("connect.php");
    $ins = $conn->prepare("select * from products where idproduct=:id");
    $ins->execute(array('id' => $id));
    $tab = $ins->fetchAll();
    foreach ($tab as $image) :

    ?>

        <div class="product-box">
            <div class="wrapper">
                <div class="product-box">
                    <div class="all-images">
                        <div class="main-image">
                            <img src="<?php echo $image['path']; ?>" alt="laptop" width="60%" id="imagebox">
                        </div>


                    <?php endforeach; ?>

                    <div class="small-images">

                        <img src="<?php echo $image['path']; ?>" alt="laptop" class="sub-small-images" width="13%" onclick="clickimg(this)">
                        <img src="img/<?php echo $id . "_2." . $extension; ?>" alt="laptop" class="sub-small-images" width="13%" onclick="clickimg(this)">
                        <img src="img/<?php echo $id . "_3." . $extension; ?>" alt="laptop" class="sub-small-images" width="13%" onclick="clickimg(this)">
                        <img src="img/<?php echo $id . "_4." . $extension; ?>" alt="laptop" class="sub-small-images" width="13%" onclick="clickimg(this)">
                    </div>




                    </div>
                </div>
                <div class="text">
                    <h5>PCs </h5><br>

                    <h2><?php echo $image['title']; ?></h2><br>

                    <!-- rating problem!!!! -->
                    <div class="price-box">
                        <p class="price">Price: $<b><?php echo $image['price']; ?></b></p>
                        <!-- <strike>$1500</strike> -->
                    </div><br>
                    <p>
                        Color <select name="color">
                            <!-- <option>Select Color</option> Pour qu'il soit par defaut en biege si il a ordonné et pas modifier la couleur-->
                            <option value="Biege">Biege</option>
                            <option value="Pink">Pink</option>
                            <option value="Purpule">Purpule</option>
                            <option value="Blue">Blue</option>
                        </select>
                    </p><br>
                    <form action="Cart-Page.php" method="get">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <p>Quantity <input type="number" name="Quantity" value="1" class="Quantity"></p><br>
                        <input class="shopping" type="submit" name="Add-To-Cart" value="Add To Cart"><br><br>

                    </form>


                    <h4>More Details</h4><br>
                    <span>
                        <?php echo $image['description']; ?>
                    </span>
                </div>
            </div>

        </div>


        <footer>
            <div id="copy">
                <img id="copyright" src="icons/-copyright_90662.ico" alt="copyright">
                <h3>Team Dyalna 2022, All Rights Reserved</h3>
                <!--à faire: ajout de l'icone de rights-->
            </div>
        </footer>
</body>

</html>