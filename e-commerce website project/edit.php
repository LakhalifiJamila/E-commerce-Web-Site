<?php session_start();
if ($_SESSION['adminexist'] == 0) {
    header('location:signin.php');
} ?>
<?php

// check if id not available redirect to adminpage




if (isset($_POST['update'])) {
    $title = $_POST['prodname'];
    $desc = $_POST['description'];
    $quantity = $_POST['prodquantity'];
    $price = $_POST['prodprice'];

    echo $title;
    echo $desc;
    echo $quantity;
    echo $price;



    // $newImage = $_FILES['prodimage'];
    // $fromPath = $newImage['tmp_name'];
    // $imageName = $newImage['name'];
    // $toPath = "images/" . $imageName;
    // $extension = explode(".", $imageName);
    // $extension = end($extension);
    // $size = $newImage['size'];

    // if ($newImage['size'] < 10000000 && ($extension == "png" || $extension == "jpg" || $extension == "jpeg"))
    // {

    //     if (move_uploaded_file($fromPath, $toPath))
    //     {

    //         // $path = $_POST['path'];
    $id = $_POST['hiddenId'];
    include("connect.php");
    $preparedObject = $conn->prepare('update products set title=?, description=?,quantity=?, price=? where idproduct=?'); //  after title   , description=?, quantity=?, price=?, path=?
    $preparedObject->execute([$title, $desc, $quantity, $price, $id]);  // , $desc, $quantity, $price, $path
    header("location:products.php");
    //         // header("location:products.php");
    exit;
    //         echo "<script>alert('file updated successfuly')</script>";
    //     }
    //     else
    //     {
    //         echo "<script>alert('we couldnt update the image')</script>";
    //     }
    // }
    // else
    // {
    //     echo "<script>alert('file must be a picture and of size < 10 MB')</script>";
    // }
}




if (isset($_GET)) {
    $id = $_GET['id'];
    include("connect.php");
    $preparedObject = $conn->prepare("select * from products where idproduct=?");
    $preparedObject->execute([$id]);
    $result = $preparedObject->fetchAll();

    if (count($result) > 0) {
        $title = $result['0']['title'];
        $desc = $result['0']['description'];
        $quantity = $result['0']['quantity'];
        $price = $result['0']['price'];
        $path = $result['0']['path'];

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style1.css">
            <title>Edit Product</title>
        </head>

        <body>
            <center>
                <div class="main">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h2>Edit Product</h2>
                        <input type="text" value="<?php echo " $title" ?>" id="prodname" name="prodname" placeholder="product TITILE"><br>
                        <input type="text" value="<?php echo " $price" ?>" id="prodprice" name="prodprice"><br>
                        <input type="text" value="<?php echo " $quantity" ?>" id="prodquantity" name="prodquantity"><br>
                        <input type="text" value="<?php echo " $id" ?>" name="hiddenId" style="display:none"><br>
                        <textarea name="description" id="moredetails"><?php echo $desc ?></textarea>
                        <!-- <input type="file" id="prodimage" name="prodimage"><br> -->
                        <!-- <label for="prodimage">Choose image</label> -->
                        <button name="update" type="submit">Update Product ✅</button><br>
                        <!-- <a href="products.php">See all Products</a><br><br> -->
                        <p>Developed by: HOSSAIN AHACHI, KAWTAR SABIR and JAMILA LAKHLIFI</p>

                    </form>
                </div>
            </center>
        </body>

        </html>



<?php
    }
}

?>