<?php session_start();
if ($_SESSION['adminexist'] == 0) {
    header('location:signin.php');
} ?>
<?php

  echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">';
    

if (isset($_POST["upload"])) {
    $TITLE = $_POST['prodname'];   // prod name entered by user
    $DESCRIPTION = $_POST['moredetails'];
    $QUANTITY = $_POST['prodquantity'];
    $PRICE = $_POST['prodprice']; //prod price entered by user
    $IMAGE = $_FILES['prodimage']; // file submited by user

    $IMAGE2 = $_FILES['prodimage2']; // file submited by user
    $IMAGE3 = $_FILES['prodimage3']; // file submited by user
    $IMAGE4 = $_FILES['prodimage4']; // file submited by user

    $fromPath = $_FILES['prodimage']['tmp_name']; // file temp path folder
    $fromPath2 = $_FILES['prodimage2']['tmp_name']; // file temp path folder
    $fromPath3 = $_FILES['prodimage3']['tmp_name']; // file temp path folder
    $fromPath4 = $_FILES['prodimage4']['tmp_name']; // file temp path folder

    $image_name = $_FILES['prodimage']['name'];
    $image_name = $_FILES['prodimage']['name']; // file name 
    $size = $IMAGE['size'];
    $size2 = $IMAGE2['size'];
    $size3 = $IMAGE3['size'];
    $size4 = $IMAGE4['size'];

    $fileExtension = explode(".", $_FILES['prodimage']['name']);
    $fileExtension = end($fileExtension);

    $fileExtension2 = explode(".", $_FILES['prodimage2']['name']);
    $fileExtension2 = end($fileExtension2);
    $fileExtension3 = explode(".", $_FILES['prodimage3']['name']);
    $fileExtension3 = end($fileExtension3);
    $fileExtension4 = explode(".", $_FILES['prodimage4']['name']);
    $fileExtension4 = end($fileExtension4);


    include("connect.php");

    $preparedObject = $conn->prepare("select * from products");
    $preparedObject->execute();
    $result = $preparedObject->fetchAll();
    if ((count($result) == 0)) {
        $result = 0;
    } else {
        $result = end($result);
        $result = $result['idproduct'];
    }
    $result = $result + 1;   //  last id in database + 1
    $toPath = "img/" . $result . "." . $fileExtension;  // path where to save file into
    $toPath2 = "img/" . $result . "_2." . $fileExtension;  // path where to save file into
    $toPath3 = "img/" . $result . "_3." . $fileExtension;  // path where to save file into
    $toPath4 = "img/" . $result . "_4." . $fileExtension;  // path where to save file into


    if ($TITLE && $DESCRIPTION && $QUANTITY && $PRICE && $IMAGE && $IMAGE2 && $IMAGE3 && $IMAGE4)   // if the fields are not empty
    {

        $CONDITION1 = $size < 10000000 && ($fileExtension == "png" || $fileExtension == "jpg" || $fileExtension == "jpeg");
        $CONDITION2 = $size2 < 10000000 && ($fileExtension2 == "png" || $fileExtension2 == "jpg" || $fileExtension2 == "jpeg");
        $CONDITION3 = $size3 < 10000000 && ($fileExtension3 == "png" || $fileExtension3 == "jpg" || $fileExtension3 == "jpeg");
        $CONDITION4 = $size4 < 10000000 && ($fileExtension4 == "png" || $fileExtension4 == "jpg" || $fileExtension4 == "jpeg");

        if ($CONDITION1 && $CONDITION2 && $CONDITION3 && $CONDITION4) {
            if (move_uploaded_file($fromPath, $toPath)) {
                // header("location:products.php");
                include("connect.php"); // connecting to the database
                $preparedObject = $conn->prepare("insert into products (title,description,quantity,price,path) values (?,?,?,?,?)"); // prepare the object
                $preparedObject->execute([$TITLE, $DESCRIPTION, $QUANTITY, $PRICE, $toPath]); // execute the object
                echo "<script>alert('file uploaded successfuly')</script>";
            } else {
                echo "<script>alert('file couldnt be uploaded')</script>";
            }
            if (move_uploaded_file($fromPath2, $toPath2)) {
                echo "<script>alert('file 1 uploaded successfuly')</script>";
            } else {
                echo "<script>alert('file couldnt be uploaded')</script>";
            }

            if (move_uploaded_file($fromPath3, $toPath3)) {
                echo "<script>alert('file 2 uploaded successfuly')</script>";
            } else {
                echo "<script>alert('file couldnt be uploaded')</script>";
            }
            if (move_uploaded_file($fromPath4, $toPath4)) {
                echo "<script>alert('file 3 uploaded successfuly')</script>";
            } else {
                echo "<script>alert('file 4 couldnt be uploaded')</script>";
            }
        } else {
            echo "<script>alert('file must be a picture and of size < 10 MB')</script>";
        }
    } else {
        // header("location:add.php");
        echo "<script>alert('make sure all inputs are valid ')</script>";
    }
    // include_once("add.php");
    echo " <a href='products.php'> <button type='button' class='btn btn-success'>See all products</button>
    </a>";
} else {
    header("location:add.php");
}
