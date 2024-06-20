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
    <link rel="stylesheet" href="../css/orders.css">
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    .shopping-cart {
        border-radius: 8px;
        background-color: #eee;
        /* background-color: #3e4451; */
    }

    .butn-delete {
        height: fit-content;
        width: fit-content;
        padding: 10px;
        margin: 2px;
        background-color: #dc3545;
        border-radius: 8px;
    }

    .btns,
    .count {
        border-radius: 8px;
    }

    .count {
        width: 100px;
    }

    .plus-btn {
        background-color: #198754;
    }

    .minus-btn {
        background-color: #dc3545;
    }

    @media only screen and (max-width: 600px) {
        .butn-delete {
            position: absolute;
            top: 0px;
            left: 0px;

            transform: translate(25%, 32%);
        }
    }

    .item {
        position: relative;
        height: 25vh;
        display: flex;
        overflow: hidden;
        align-items: center;
        justify-content: space-evenly;
        box-shadow: 0px 0px 8px black;
    }


    .item img {
        width: 200px;
        height: 165px;
    }
    </style>
</head>

<body>
    <?php
    session_start();
    // if(empty($_SESSION["name"])){header("location: login.php");die();}
    $username = !empty($_SESSION) && isset($_SESSION["name"])? $_SESSION["name"]:"";
    ?>
    <nav class="ms-md-2 me-md-2 mb-8 ps-1 pe-2">
        <div class="col-12 d-flex justify-content-between  p-1 container">
            <div class="col-10 col-md-12 d-block d-md-flex nav-content justify-content align-items-end">
                <div class="logo col-4  ">
                    <h1 class="m-0">DeepSpace</h1>
                    <h3><?php echo $username?$username:"" ?></h3>
                </div>
                <ul class="col-6 d-block d-md-flex justify-content-between " id="navbar-but">
                    <li class="ms-3 "><a href="../index.php">Home</a></li>
                    <li class="ms-3 "><a href="">Products</a></li>
                    <li class="ms-3 active"><a href="cart.php">Cart</a></li>
                    <li class="ms-3"><a href="cart.php">About</a></li>
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
    <div class="content container">
        <div class="shopping-cart">
            <!-- Title -->
            <div class="title title p-3 text-center">
                Shopping Bag
            </div>
            <?php 
        require_once("./config.php");
           $sql = "SELECT id_p,title,price,imag FROM `product`";

           if($stmt = $con->prepare($sql)){
            if($stmt->execute()){
                $stmt->store_result();
                $stmt->bind_result($id_p,$title,$price,$path);
                while($stmt->fetch()){
                     ?>
            <!-- Product #1 -->
            <div class='item text-center col-md-12'>
                <div class='buttons butn-delete col-md-1'>

                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class='image col-md-3'>
                    <img class='image' src='../imgs/<?php echo $path?>' alt='$title' />
                </div>
                <div class='description col-md-7 d-md-flex  justify-content-between'>
                    <span class="col-md-4">
                        <h4><?php echo $title ?></h4>
                        <h4><?php echo $price."$" ?></h4>
                    </span>
                    <div class='quantity col-md-8'>

                        <button class='plus-btn btns' type='button' name='button'>
                            <i class="fa-solid fa-plus"></i> </button>
                        <input type='text' class="count text-center" name='name' value='5' readonly>
                        <button class='minus-btn btns' type='button' name='button'>
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                    <div class="">

                        <input type='text' class="price text-center" name='name' value='5' readonly>
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
    <script src="../js/public.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>


</body>