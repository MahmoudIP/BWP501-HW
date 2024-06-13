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
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    body {
        background-image: url(./imgs/header.jpg);
        background-size: cover;
    }

    .navbar {
        position: sticky;
        top: 13px;
        backdrop-filter: blur(8px);
        background-color: transparent !important;
        border-radius: 14px;
        color: var(--main-color);
        padding: 0px;
    }

    .navbar-brand {
        color: var(--main-color);
        font-size: 1.55rem;
    }

    .log h5 {
        margin-top: -46px;
    }

    @media (max-width: 767.98px) {
        .log h5 {
            font-size: 14px;
        }
    }

    .form-control:active .form-control:hover,
    .form-control:focus {
        background-color: #10cab778 !important;
    }

    .navbar-brand:focus,
    .navbar-brand:hover {
        text-shadow: 0px 0px 9px var(--main-color);
    }

    .navbar-toggler:focus {
        text-decoration: none;
        outline: 0;
        box-shadow: 0 0 0 0;
    }

    .nav-link {
        color: white !important;
    }

    .btn-color:hover,
    .btn-color:active,
    .btn-color:focus {
        background-color: var(--main-color) !important;
        color: white !important;
    }

    .btn-color {
        color: var(--main-color);
        border-color: var(--main-color);
    }

    .btn-color:hover {
        color: white;
        border-color: var(--main-color);
        background-color: var(--main-color);
    }

    .form-control {
        background-color: #10cab74d;
    }

    .landing {
        background-image: url(./imgs/header.jpg);
        background-size: cover;
        height: calc(100vh);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: -47px;

    }

    .landing h1 {
        color: var(--main-color);
        font-size: 4rem;
    }

    .active {
        color: var(--main-color) !important;
    }

    .landing p {
        text-wrap: wrap;
        font-size: 1.5rem;
        width: 51%;
        margin: auto;
        color: white;
        text-align: center;
    }
    </style>
</head>

<body>
    <?php
    session_start();
    
    $username = !empty($_SESSION)? $_SESSION["username"]:"";
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
                        <a class="nav-link " aria-current="page" href="./index.php">Home</a>
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