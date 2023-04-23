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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="products1.css">
    <title>products</title>
</head>

<body>
    <div class="center">
        <?php
        // echo "<a href= 'add.php' >Add Product </a>  ";

        include("connect.php");
        $preparedObject = $conn->prepare("select * from products");
        $preparedObject->execute();
        $tableau = $preparedObject->fetchall();
        if (count($tableau) > 0) {
            foreach ($tableau as $obj) {
                $id = $obj['idproduct'];
                $title = $obj['title'];
                $description = $obj['description'];
                $price = $obj['price'];
                $path = $obj['path'];
                // echo $id;
                // echo "<br>";
                // echo $title;
                // echo "<br>";
                // echo $description;
                // echo "<br>";
                // echo $price;
                // echo "<br>";
                // echo $path;

                // <p class='card-text'>$description.</p>  
                // <p class='card-text'>$description.</p>  

                echo "
                            <div class='h'>
                                <div class='card h' style='width: 18rem;'>
                                    <img class='card-img-top' src=$path alt='Card image cap' width = '200px' height= '200px'>
                                    <div class='card-body'>
                                        <h5 class='card-title' >$id) $title</h5>
                                        
                                        <a href='edit.php?id=$id' class='btn btn-primary'>Edit</a>
                                        <a href='delete.php?id=$id' class='btn btn-danger'>delete</a>
                                        <h6> $price $</h6>
                                    </div>
                                </div>
                            </div>

                ";
            }
        } else  // if $fetch results is null
        {
            echo "No products";
        }
        ?>

    </div>

</body>

</html>