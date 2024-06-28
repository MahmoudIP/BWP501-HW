<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepSpace</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/products.css">
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <?php
    session_start();
    // if(empty($_SESSION["name"])){header("location: login.php");die();}
    $username = !empty($_SESSION) && isset($_SESSION["name"])? $_SESSION["name"]:null;
?>
    <nav class="ms-md-2 me-md-2 mb-8 ps-1 pe-2">
        <div class="col-12 d-flex justify-content-between  p-1 container">
            <div class="col-10 col-md-12 d-block d-md-flex nav-content justify-content align-items-end">
                <div class="logo col-4  ">
                    <h1 class="m-0">DeepSpace</h1>
                    <h3><?php echo $username?$username:"" ?></h3>
                </div>
                <ul class="col-8 col-lg-6 d-block d-md-flex justify-content-between " id="navbar-but">
                    <li class="ms-3 "><a href="../index.php">Home</a></li>
                    <li class="ms-3 active"><a href="">Products</a></li>
                    <li class="ms-3"><a href="orders.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
                    <li class="ms-3"><a
                            href='./<?php echo $username?"logout.php":"login.php" ?>'><?php echo $username?"Logout":"Login" ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ps-2 pe-2 col-2 m-2 mt-3 d-md-none nav-but" id="nav-but">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </nav>

    <?php if( !empty($username) ){ ?>
    <span class="cart-butn-flut d-md-none">
        <a href="./orders.php">
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </span>
    <?php } ?>

    <div class=" text-center">

        <div class="row grid gap m-auto container">

            <?php 
           
           require_once("../php/config.php");
           $sql = "SELECT id_p,description,title,price,imag FROM `product` WHERE stock>0";

           if($stmt = $con->prepare($sql)){
            if($stmt->execute()){
                $stmt->store_result();
                $stmt->bind_result($id_p,$description,$title,$price,$path);
                while($stmt->fetch()){
                        ?>
            <div class='p-2 col-12 col-md-6 col-lg-4 '>
                <div class='card' id="<?php echo $id_p ?>">
                    <img src='../imgs/<?php echo $path?>' class='card-img-top p-2' loading='lazy' alt='...' />

                    <div class='card-body'>
                        <h5 class='card-title'><?php echo $title?></h5>
                        <p class='card-text'>
                            <?php echo  $price?> SYP
                        </p>
                        <p><?php echo $description?></p>

                        <input type="hidden" name="id" value="<?php echo $id_p?>"
                            <?php echo isset($_COOKIE[$username]["cart"][$id_p])?"added":"" ?>>
                        <input type="button"
                            class="btn  <?php echo isset($_COOKIE[$username]["cart"][$id_p])?"added":"" ?>"
                            value="<?php echo isset($_COOKIE[$username]["cart"][$id_p])?"Remove":"Add To Cart" ?>">
                        <br>
                        <label id="mes" class="d-none" for="">login first <a href="../php/login.php">login</a></label>

                    </div>
                </div>
            </div>
            <?php
                    }
                }
           }
           ?>



        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let cartButtons = document.querySelectorAll(".card  input[type='button']");
        cartButtons.forEach(butn => {
            let card = butn.closest(".card");
            let id = card.querySelector("input[name='id']");
            let typeModify = id.hasAttribute("added") ? "Remove" : "Add";

            butn.addEventListener("click", (e) => {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "./modify_content.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.status == "success") {
                            if (response.message == "added") {
                                id.setAttribute("added", "");
                                butn.value = "Remove";
                                butn.classList.toggle("added")
                            } else if (response.message == "removed") {
                                id.removeAttribute("added");
                                butn.value = "Add To Cart";
                                butn.classList.toggle("added")
                            } else {
                                // window.location = "login.php"
                                card.querySelector("#mes").classList.toggle("d-none");
                                card.querySelector("#mes").classList.toggle("mes");
                            }
                        } else {
                            console.log(response.message);
                        }
                    }
                };

                xhr.send("id=" + id.value + "&type_modify=" + (id.hasAttribute("added") ?
                    "Remove" : "Add"));

            })

        });
    });
    </script>
    <script src="../js/public.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>



</body>

</html>