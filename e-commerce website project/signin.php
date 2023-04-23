<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signincss2.css">
    <script src="https://kit.fontawesome.com/062cec4cf7.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    $USER_DATA;
    define("ADMIN", [
        'password' => 'admin',
        'name' => 'ADMIN',
        'email' => 'admin@gmail.com'
    ]);
    session_start();
    $_SESSION['exist'] = 0;
    $_SESSION['adminexist'] = 0;
    // Validation du formulaire login
    if (isset($_POST['submitlogin']) &&  isset($_POST['password'])) {
        if ($_POST['password'] == "" || $_POST['email'] == "") {
    ?> <script>
                alert('veuillez saisir tout les donnees');
            </script>
    <?php
        } else {
            // ANMIN ?
            if (ADMIN['email'] == $_POST['email'] && ADMIN['password'] == $_POST['password']) {
                $ara = array();
                $ara = ADMIN;
                $_SESSION['USER_INFOadmin'] = $ara;
                $_SESSION['adminexist'] = 1;
                $_POST['submitlogin'] = "";
            } else {
                include 'connect.php';
                $select = $conn->prepare('SELECT * FROM clients');
                $select->execute();
                $tab1 = $select->fetchAll();
                foreach ($tab1 as  $USER_DATA) {
                    if ($USER_DATA['email'] == $_POST['email'] &&  $USER_DATA['password'] == md5($_POST['password'])) {
                        $_SESSION['USER_INFO'] = $USER_DATA;
                        $_SESSION['exist'] = 1;
                        $_POST['submitlogin'] = "";
                    }
                }
            }
        }
    }

    // Validation du formulaire sign up
    if (isset($_POST["submitsignup"])) {
        if ($_POST['email1'] != "" && $_POST['lastname'] != "" && $_POST['name'] != "" && $_POST['password1'] != "" && $_POST['password2'] != "") {
            if ($_POST['password1'] == $_POST['password2']) {
                $ind = 1;
                include 'connect.php';
                $select = $conn->prepare('SELECT * FROM clients');
                $select->execute();
                $tabb = $select->fetchAll();

                foreach ($tabb as $res) {
                    if ($res['email'] == $_POST['email1']) {
                        echo "<script>alert('se compte existe deja')</script>";
                        $ind = 0;
                    }
                }
                if ($ind != 0) {
                    $select = $conn->prepare('INSERT into clients(firstname,lastname,email,password,sold) values(?,?,?,?,?)');
                    $sold = rand(0, 10000);
                    $pw = md5($_POST['password1']);
                    $select->execute([$_POST['name'], $_POST['lastname'], $_POST['email1'], $pw, $sold]);
                    $USER_DATA = $conn->prepare("select * from clients");
                    $USER_DATA->execute();
                    $USER_DATA = $USER_DATA->fetchAll();
                    $USER_DATA = end($USER_DATA);
                    $_SESSION['USER_INFO'] = $USER_DATA;
                    $_SESSION['exist'] = 1;
                }
            }
        }
    }





    ?>

    <?php if ($_SESSION['adminexist'] == 0 &&  $_SESSION['exist'] == 0) : ?>

        <div class="container">
            <div class=formc>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="login">
                        <h2>log in</h2>
                    </div>
                    <div class="inputlogin">
                        <i class="fas fa-user"></i>
                        <input type="email" id="email" name="email" placeholder="email@exemple.com">
                        <!--fonction-->
                    </div>
                    <div class="inputlogin">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="password">
                    </div>
                    <input type="submit" name="submitlogin" class="btn">
                    <!-- <div>
                            <p class="gotosigninup">don't have an acount ?<a href="" style="text-decoration:none ">sign in</a></p>  
                       </div> -->
                </form>
            </div>

            </form>
            <div class="signinc">
                <form action="" method="post" name="fo" onsubmit="effacer()">
                    <div class="singnin">
                        <h2>sign in</h2>
                    </div>
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
                        <input type="email" id="email1" name="email1" placeholder="email@exemple.com" onblur="validatemail()">
                        <!--fonction-->
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
            <div class="panels-container">
                <div class="contanerpanel">
                    <div class="panel-left-panel">
                        <div class="donthave">
                            <h1>to log in </h1>
                            <p>click on</p>
                            <button id="loginbutton" value="mama">log in</button>
                        </div>

                    </div>
                    <div class="panel-right-panel">
                        <!-- <h1>don't have an acount ? </h1>
                    <p>click on</p> -->
                        <div class="donthave">
                            <h1>don't have an acount ? </h1>
                            <p>click on</p>
                            <button id="signupbutton">sign up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
    Si utilisateur/trice bien connectée on affiche un message de succès-->
    <?php else :
        if ($_SESSION['adminexist'] == 1)
            header('location:adminPage.php'); // page admin
        else
            header('location:Accueil.php'); // page client
    endif;
    ?>
    <script src="conside2.js"></script>
    </script>
</body>

</html>