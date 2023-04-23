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
    <link rel="stylesheet" href="Accueil.css">
    <title>Accueil</title>
</head>


<body>



    <?php include_once('header.php'); ?>
    <h1 class="welcome">WELCOME TO OUR WEBSITE</h1>
    <h2 class="product-category">Top sales</h2>
    <!-- cette foreach pour la page d'accueil -->
    <?php
    include("connect.php");
    $ins = $conn->prepare("select * from products");
    $ins->execute();
    $tab = $ins->fetchAll();
    foreach ($tab as $row) :
        $Extension = explode(".", $row['path']);
        $Extension = end($Extension);
    ?>
        <a href="Product_Description.php?id=<?php echo $row['idproduct']; ?>&Extension=<?php echo $Extension; ?> ">
            <img width="200px" src="<?php echo $row['path']; ?>" id="<?php echo $row['idproduct']; ?>" alt="img" onclick="window.location.href='Product_Description.php'" ;>
        </a>
    <?php endforeach; ?>

    <footer>
        <div id="copy">
            <img id="copyright" src="icons/-copyright_90662.ico" alt="copyright">
            <h3>Team Dyalna 2022, All Rights Reserved</h3>
            <!--à faire: ajout de l'icone de rights-->
        </div>
    </footer>

</body>

</html>