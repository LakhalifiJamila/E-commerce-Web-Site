<?php session_start();
if ($_SESSION['exist'] == 0) {
    header('location:signin.php');
} ?>
<link rel="stylesheet" href="Cart-Page.css">
<link rel="stylesheet" href="Product_Description.css">

<?php
    
if (isset($_GET['Add-To-Cart'])) {
    $id_user = $_SESSION['USER_INFO']['id'];

    $id_product = $_GET['id'];

    $Quantity = $_GET['Quantity'];

    include("connect.php");

    $qt = $conn->prepare("select * from products where idproduct=:id ");
    $qt->execute(array('id' => $id_product));
    $qt_bd = $qt->fetchAll();
    foreach ($qt_bd as $qt) {
        $quantity = $qt['quantity'];
        $price_product = $qt['price'];
    }
}
if ($quantity >= $Quantity) {
    $rq = $conn->prepare("select * from clients where id=:id ");
    $rq->execute(array('id' => $id_user));
    $rq_res = $rq->fetchAll();
    foreach ($rq_res as $res)
        $compte_solde = $res['sold'];

    $ins = $conn->prepare('insert into shopingcard(id_user, id_product, quantity) values(?,?,?)');
    $ins->execute([$id_user, $id_product, $Quantity]);

    $total = $conn->prepare('select * from shopingcard where id_user=:id');
    $total->execute(array('id' => $id_user));
    $All_total = $total->fetchAll();

    $somme = 0;
    foreach ($All_total as $total) {
        $ID_PRODUCT = $total['id_product'];
        //connect on product and get price
        $price = $conn->prepare('select price from products where idproduct=:id');
        $price->execute(array('id' => $ID_PRODUCT));
        $price_product = $price->fetchAll();
        foreach ($price_product as $key => $value) {
            $somme = $somme + $total['quantity'] * $value['price'];
        }
    }
    
    echo "<h1 >TOTAL TO PAY IS $somme $</h1>";
?>
    <form action="" method="post">
        <input type="hidden" name="somme" value=<?php echo $somme; ?>>
        <input type="submit" name="Buy" value="Buy ALL WHAT IS IN  SHOPING CART" class="shopping">
    </form>
    <a href='accueil.php'>Go Back to Accueil</a>

<?php
    if (isset($_POST['Buy'])) {
        $somme = (float)$_POST['somme'];
        if ($compte_solde > $somme) {
            $compte_solde = $compte_solde - $somme;
            $ins = $conn->prepare('update clients set sold=:sold where id=:id');
            $ins->execute(['sold' => $compte_solde, 'id' => $id_user]);
            echo " <script>alert('ACHAT RUESSI')</script>";
        } else {
            echo " <script>alert('Votre solde est insuffisant')</script>";
            
        }
        $del = $conn->prepare('DELETE from shopingcard where id_user=:id_utilisateur');
        $del->execute(['id_utilisateur' => $id_user]);
        
    }
} else {
    echo " <script>alert('Quantité hors stock')</script>";
}
?>