<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepSpace</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
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
    $username = !empty($_SESSION)? $_SESSION["name"]:"";
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <div class="log">
                <a class="navbar-brand" href="./index.php">
                    <h1>DeepSpace </h1>
                </a>
                <?php echo $username?"<br><h5> $username </h5>":"" ?>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo empty($_SESSION)?"./login.php":"./logout.php" ?>">

                            <span class=".logflag">
                                <?php echo empty($_SESSION)?"login":"logout" ?>
                            </span>
                        </a>
                    </li>



                    <!-- <li class="nav-item">  <a class="nav-link " aria-disabled="true" href="#">Disabled</a>   </li> -->
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-color btn-outline-success" type="submit">Search</button>
                </form>
            </div>

        </div>
    </nav>
    <!-- Start landing  -->
    <div class="landing">
        <div class="intro-text">
            <h1 class="d-flex justify-content-center align-itmes-center">Hello There </h1>
            <p class="d-flex justify-content-center align-itmes-center">Fast and secure, be good </p>
        </div>
    </div>
    <!-- End landing  -->

    <div class=" text-center">
        <div class="row grid gap m-0">
            <div class="p-2 col-12 col-md-6 col-lg-4 ">
                <div class="card">
                    <img src="./imgs/header.jpg" class="card-img-top" alt="..." />

                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make up the bulk of
                            the card's content.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <?php 
           
            echo "
            <div class='p-2 col-12 col-md-6 col-lg-4 '>
                <div class='card'>
                    <img src='./imgs/header.jpg' class='card-img-top' alt='...' />

                    <div class='card-body'>
                        <h5 class='card-title'>Card title</h5>
                        <p class='card-text'>
                            Some quick example text to build on the card title and make up the bulk of
                            the card's content.
                        </p>
                        <a href='./product.php?id=id' class='btn btn-primary'>Go somewhere</a>

                    </div>
                </div>
            </div>
            "
            ?>




            <div class="p-2 col-12 col-md-6 col-lg-4 ">
                <div class="card" aria-hidden="true" style="height:100%;">
                    <img src="..." class="card-img-top" alt="..." style="height:50%" />
                    <div class="card-body">
                        <h5 class="card-title placeholder-glow">
                            <span class="placeholder col-6"></span>
                        </h5>
                        <p class="card-text placeholder-glow">
                            <span class="placeholder col-7"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-8"></span>
                        </p>
                        <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>



</body>

</html>