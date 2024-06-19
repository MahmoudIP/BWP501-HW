<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepSpace</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/header.css">
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    .card {
        max-height: fit-content;
    }
    </style>
</head>

<body>
    <?php
    session_start();
    $username = !empty($_SESSION)? $_SESSION["name"]:"";
?>
    <!-- Navigation Bar-->
    <nav class="ms-md-2 me-md-2 mb-8 ps-1 pe-2">
        <div class="col-12 d-flex justify-content-between  p-1 container">
            <div class="col-10 d-block d-md-flex nav-content justify-content align-items-end">
                <div class="logo col-4  ">
                    <h1 class="m-0">DeepSpace</h1>
                    <h3><?php echo $username?$username:"" ?></h3>
                </div>
                <ul class="col-6 d-block d-md-flex justify-content-between " id="navbar-but">
                    <li class="ms-3 active"><a href="index.php">Home</a></li>
                    <li class="ms-3"><a href="">Product</a></li>
                    <li class="ms-3"><a href="cart.php">Cart</a></li>
                    <li class="ms-3"><a href="">About</a></li>
                    <li class="ms-3"><a
                            href='./<?php echo $username?"login.php":"logout.php" ?>'><?php echo $username?"Logout":"Login" ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ps-2 pe-2 col-2 m-2 mt-3 d-md-none nav-but" id="nav-but">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </nav>
    <!--end of navigation Bar-->
    <!--Cart-->
        <div class="shopping-cart">
            <!-- Title -->
            <div class="title">
        Shopping Bag
    </div>
    <?php 
        require_once("./php/config.php");
           $sql = "SELECT id_p,title,price,imag FROM `product`";

           if($stmt = $con->prepare($sql)){
            if($stmt->execute()){
                $stmt->store_result();
                $stmt->bind_result($id_p,$title,$price,$path);
                while($stmt->fetch()){
                    echo " 
    <!-- Product #1 -->
    <div class='item'>
        <div class='buttons'>
        <span class='delete-btn'>X</span>
        </div>
                <div class='image'>
                <img class='image' src='./imgs/$path' alt='$title' />
                </div>
                <div class='description'>
                <span>$title</span>
                </div>
 
            <div class='quantity'>
            <button class='plus-btn' type='button' name='button'> + </button>
            <input type='text' name='name' value='5'>
            <button class='minus-btn' type='button' name='button'>-</button>
            </div>
            <div class='total-price'>$price</div>
    </div>
    ";
                    }
            }
           }
           ?>
    </div>
    <!--footer-->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 Company, Inc</p>
        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
     </footer>
    </div>
    <!--End of footer-->
    <script src="js/cart.js"></script>
    <script src="js/public.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
</body>
