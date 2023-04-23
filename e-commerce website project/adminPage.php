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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="adminPage.css">
  <title>admin page</title>
</head>

<body>
  <center>
    <h1>welcome <?php echo $_SESSION['USER_INFOadmin']['name'] ?></h1>

    <a href="add.php"> <button type="button" class="btn btn-info">ADD A NEW PRODUCT</button> </a>
    <a href="products.php"> <button type="button" class="btn btn-primary">SEE ALL PRODUCTS TO EDIT OR TO DELETE</button> </a>
    <a href="deconnexion.php"> <button type="button" class="btn btn-danger">DISCONNECT</button> </a>
  </center>
</body>

</html>