<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="loginsignupcss2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 session_start();
 $_SESSION['exist']=0;
 // Validation du formulaire sign up
if (isset( $_POST["submitsignup"]) ) {
    if(   $_POST['email1']!="" && $_POST['lastname']!="" && $_POST['name']!="" && $_POST['password1']!="" && $_POST['password2']!="")   {
        if($_POST['password1'] == $_POST['password2']){
            $ind=1;
            include 'connect.php';
            $select=$conn->prepare('SELECT * FROM clients');
            $select->execute();
            $tabb=$select->fetchAll();
           
             foreach($tabb as $res){
                if($res['email'] == $_POST['email1'] ){
                    echo "<script>alert('se compte existe deja')</script>";
                    $ind=0;
                    
                }
            }
            if ($ind!=0) {
                $select=$conn->prepare('INSERT into clients(firstname,lastname,email,password,sold) values(?,?,?,?,?)');
                $select->execute([$_POST['name'],$_POST['lastname'],$_POST['email1'],md5($_POST['password1']),rand(0, 10000)]);
                $_SESSION['USER_INFO']=$_POST;
                $_SESSION['exist']=1;
            }
        }}

    }
?>
 <?php if( $_SESSION['exist']== 0): ?>
      <div class="signinc">
            <form action="" method="post" name="fo" onsubmit="effacer()">
                 <div class="singnin"><h2>sign in</h2> </div>        
                    <div class="inputlogin">
                        <i class="fas fa-user"></i>
                        <input type="text" id="text" name="name" placeholder="name" onblur="validateNom()">
                        <span class="erreurspan" id="errornom"></span>
                    </div>
                    <div class="inputlogin">
                        <i class="fas fa-user"></i>
                        <input type="text" id="lastname" name="lastname" placeholder="lastname" onblur="validatePrenom()">
                        <span class="erreurspan" id="errorprenom"></span>
                    </div>
                    <div class="inputlogin">
                        <i class="fas fa-user"></i>
                        <input type="email" id="email1" name="email1" placeholder="email@exemple.com" onblur="validatemail()" > <!--fonction-->
                        <span class="erreurspan" id="errorlogin"></span>
                    </div>
                    <div class="inputlogin">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password1" name="password1" placeholder="password" onblur="validatePw()">
                        <span class="erreurspan" id="errorpw"></span>
                    </div>
                    <div class="inputlogin">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password2" name="password2" placeholder="password" oninput="validatePwc()">
                        <span class="erreurspan" id="errorname"></span>
                    </div>
                    <input type="submit" value="envoyer" name="submitsignup" class="btn">
                        <!-- <div>
                                <p class="gotosigninup">don't have an acount ?<a href="" style="text-decoration:none ">sign in</a></p>
                        </div> -->
            </form>
        </div>
        <div>
        <p style="color:white"> vous avez deja un compte ? </p>
        <a href="login.php" style="color:pink"> click ici</a>
     </div>
        <?php else :
           if($_SESSION['exist']== 1)
           header('location:test2.php');// page client
           endif; 
         ?>
         <script src="conside2.js"></script>
 </body>
</html>