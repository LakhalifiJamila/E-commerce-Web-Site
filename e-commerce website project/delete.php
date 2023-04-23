<?php session_start();
if ($_SESSION['adminexist'] == 0) {
  header('location:signin.php');
} ?>

  
<?php

$id = $_GET['id'];
// echo "id of the product you clicked on is : $id";

if (isset($_GET)) {
  include("connect.php");
  $preparedObject = $conn->prepare("delete from products where idproduct=? ");
  $preparedObject->execute([$id]);
  header("location:products.php");
}
