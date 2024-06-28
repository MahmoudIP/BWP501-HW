<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepSpace</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css.map">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/index.css">
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
    .devs {
        background-color: #0000006b;
        border-radius: 19px;
        backdrop-filter: blur(6px);
        border: solid 1px var(--main-color);
        padding: 10px 0px;
        width: 80vw;
        margin: auto;
        max-width: 400px;
    }

    .intro-text ul {
        list-style: none;
        width: fit-content;
        text-align: center;
        color: white;
        font-size: 1.5rem;
        margin: auto;
        padding-inline-start: 0;
    }
    </style>
</head>

<body>
    <?php
    session_start();    
    $username = isset($_SESSION['name'])? $_SESSION["name"]:"";
?>
    <nav class="ms-md-2 me-md-2 mb-8 ps-1 pe-2">
        <div class="col-12 d-flex justify-content-between  p-1 container">
            <div class="col-10 col-md-12 d-block d-md-flex nav-content justify-content align-items-end">
                <div class="logo col-4  ">
                    <h1 class="m-0">DeepSpace</h1>
                    <h3><?php echo $username?$username:"" ?></h3>
                </div>
                <ul class="col-8 col-lg-6 d-block d-md-flex justify-content-between " id="navbar-but">
                    <li class="ms-3 active"><a href="index.php">Home</a></li>
                    <li class="ms-3"><a href="./php/products.php">Products</a></li>
                    <li class="ms-3"><a href="./php/orders.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a></li>
                    <li class="ms-3"><a
                            href='./php/<?php echo $username?"logout.php":"login.php" ?>'><?php echo $username?"Logout":"Login" ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ps-2 pe-2 col-2 m-2 mt-3 d-md-none nav-but" id="nav-but">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </nav>
    <!-- Start landing  -->
    <div class="landing">
        <div class="intro-text">
            <h1 class="d-flex justify-content-center align-itmes-center text-center">Welcome to Deepspace</h1><br>
            <p class="d-flex justify-content-center align-itmes-center text-center devs">SVU WEB Project</p><br>
            <!-- <p class="d-flex justify-content-center align-itmes-center">Devs: mhmod_212637 - ahmad_154538 - doha_162552 - aous_208407</p>
            <div class="d-flex justify-content-center align-itmes-center devs">
                <p>Devs: mhmod_212637 - ahmad_154538 - doha_162552 - aous_208407</p>
            </div> -->
            <div class="devs">
                <p class="d-flex justify-content-center align-itmes-center text-center">
                    Devs:
                </p>
                <ul>
                    <li>mhmod_212637 </li>
                    <li>ahmad_154538</li>
                    <li>doha_162552 </li>
                    <li>aous_208407</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End landing  -->

    <div class="row grid gap m-auto container">
        <?php if( !empty($username) ){ ?>
        <span class="cart-butn-flut d-md-none">
            <a href="./php/orders.php">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </span>
        <?php } 
           
           require_once("./php/config.php");
           $sql = "SELECT id_p,title,price,imag FROM `product` LIMIT 6";

           if($stmt = $con->prepare($sql)){
           
                if($stmt->execute()){
                    $stmt->store_result();
                    $stmt->bind_result($id_p,$title,$price,$path);
                    while($stmt->fetch()){
                        echo " 
                        <div class='p-2 col-12 col-md-6 col-lg-4' >
                            <div class=' text-center'>
                                <div class='card'>
                                    <img src='./imgs/$path' class='card-img-top p-1 img-fluid' loading='lazy' alt='...' />
                
                                    <div class='card-body'>
                                        <h5 class='card-title'>$title</h5>
                                        <p class='card-text'>
                                            $price SYP
                                        </p>
                                        <a href='./php/products.php#$id_p' class='btn btn-primary'>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                $stmt->close();
           }
        
            ?>
    </div>
    </div>
    <script src="js/public.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>



</body>

</html>