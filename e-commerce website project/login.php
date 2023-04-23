<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginsignupcss2.css">
    <script src="https://kit.fontawesome.com/062cec4cf7.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
define("ADMIN", [
    'password'=>'admin',
    'email'=>'admin@gmail.com'
  ]);
 session_start();
 $_SESSION['exist']=0;
 $_SESSION['adminexist']=0;
// Validation du formulaire login
if (isset($_POST['submitlogin']) &&  isset($_POST['password'])) {
    if($_POST['password']=="" || $_POST['email']=="" ){
        ?> <script> alert('veuillez saisir tout les donnees');</script>
        <?php 
     } else {
        // ANMIN ?
        if(ADMIN['email'] == $_POST['email'] && ADMIN['password'] == $_POST['password']){
            $ara=array();
            $ara=ADMIN;
            $_SESSION['USER_INFOadmin']=$ara;
            $_SESSION['adminexist']=1;
            $_POST['submitlogin']="";
           } else {
            include 'connect.php';
            $select=$conn->prepare('SELECT * FROM clients');
            $select->execute();
            $tab1=$select->fetchAll();
            foreach($tab1 as $res){
                if($res['email'] == $_POST['email'] && $res['password'] == md5($_POST['password'])){
                    $_SESSION['USER_INFO']=$res ;
                    $_SESSION['exist']=1;
                    $_POST['submitlogin']="";
                }}
                }
     } 
 
    
  
   }
   
   
        
?>
 <?php if( $_SESSION['adminexist']== 0 && $_SESSION['exist']== 0): ?>
<div class=formc>
           <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                 <div class="login"><h2 >log in</h2>    </div>     
                        <div class="inputlogin">
                            <i class="fas fa-user"></i>
                            <input type="email" id="email" name="email" placeholder="email@exemple.com" > <!--fonction-->
                        </div>
                        <div class="inputlogin">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="password">
                        </div>
                          <input type="submit"  name="submitlogin" class="btn">
          </form>          
     </div> 
     <div>
        <p style="color:white"> VOUS n'avez pas de compte ?</p>
        <a href="signinmobile.php" style="color:pink"> click ici</a>
     </div>
     <?php else :
    if($_SESSION['adminexist']== 1)
    header('location:test1.php');// page admin
    else
    header('location:test2.php');// page client
    endif; 
        ?>
</body>
</html>