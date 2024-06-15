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
    <!-- <link rel="stylesheet" href="css/header.css"> -->
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/header.css">

    <style>
    body {
        background-image: url(./imgs/header.jpg);
        background-size: contain;
    }

    img {
        height: 100%;
        height: 100%;
    }

    .card {
        padding: 10px;
        width: 100%;
        margin: 20px;

    }

    @media only screen and (min-width:600px) {
        .card {
            width: 64vw;
            max-width: 765px;
        }
    }

    .landin {
        /* background-image: url(./imgs/header.jpg); */
        background-size: contain;
        height: calc(100vh);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: -47px;
    }
    </style>

</head>

<body>
    <?php
    session_start();
    
    $username = !empty($_SESSION)? $_SESSION["name"]:"";
        
?>
    <!-- <nav class=" navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <div class="log">
                <a class="navbar-brand" href="./index.php">
                    <h1>DeepSpace </h1>
                </a>
                <?php
                //  echo $username?"<br><h3> $username </h3>":"" 
                ?>
            </div>
            <button class="navbar-toggler" type="button" id="but-nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" navbar-collapse  navbar-but" id="navbar-but">
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
                        <a class="nav-link" href="<?php // echo empty($_SESSION)?"./login.php":"./logout.php" ?>">

                            <span class=".logflag">
                                <?php //echo empty($_SESSION)?"login":"logout" ?>
                            </span>
                        </a>
                    </li>



                    <li class="nav-item">  <a class="nav-link " aria-disabled="true" href="#">Disabled</a>   </li>
                </ul>

            </div>

        </div>
    </nav> -->
    <nav class="ms-md-2 me-md-2 mb-8 ps-1 pe-2">
        <div class="col-12 d-flex justify-content-between  p-1 container">
            <div class="col-10 d-block d-md-flex nav-content justify-content align-items-end">
                <div class="logo col-4  ">
                    <h1 class="m-0">DeepSpace</h1>
                    <h3><?php echo $username?$username:"" ?></h3>
                </div>
                <ul class="col-6 d-block d-md-flex justify-content-between " id="navbar-but">
                    <li class="ms-3"><a href="index.php">Home</a></li>
                    <li class="ms-3"><a href="">Product</a></li>
                    <li class="ms-3"><a href="cart.php">Cart</a></li>
                    <li class="ms-3"><a href="cart.php">About</a></li>
                    <li class="ms-3"><a
                            href='./<?php echo $username?"login.php":"logout.php" ?>'><?php echo $username?"Logout":"Login" ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ps-2 pe-2 col-2 m-2 mt-3 d-md-none nav-but" id="nav-but">
                <span class="navbar-toggler-icon"></span>
            </div>
        </div>
    </nav>
    <div class="landin container">
        <?php 
                if(!empty($_GET['id']) ){
                    $id = (int)$_GET['id'];
                    require_once("./php/config.php");
                    $sql="SELECT title,price,description,imag FROM product WHERE id_p = ? ";
                    if($stmt=$con->prepare($sql)){
                        $stmt->bind_param("i",$id);
                        if($stmt->execute()){
                            $stmt->store_result();
                            // echo $stmt->num_rows;
                            if($stmt->num_rows!=0){
                                // echo "<h1>Product not found</h1>";
                                $stmt->bind_result($title,$price,$description,$imag);
                                if($stmt->fetch()){
                                   

                                    echo "
                                    <div class='card mb-3' >
  <div class='row g-0'>
    <div class='col-md-7'>
      <img src='./imgs/$imag' class='img-fluid rounded-start' alt='...'>
    </div>
    <div class='col-md-5'>
      <div class='card-body'>
        <h5 class='card-title'>$title</h5>
        <h4 class='card-title'>$price</h4>
        
        <p class='card-text'>$description</p>
        <p class='card-text'><small class='text-body-secondary'>Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>
                                    ";
                                }
                            }else{
                                echo "
                                <div class='p-2 col-12 col-md-6 col-lg-4 '>
                           <div class='card' aria-hidden='true' style='height:100%;'>
                               <img src='...' class='card-img-top' alt='...' style='height:50%' />
                               <div class='card-body'>
                                   <h5 class='card-title placeholder-glow'>
                                       <span class='placeholder col-6'></span>
                                       Not Found
                                   </h5>
                                   <p class='card-text placeholder-glow'>
                                       <span class='placeholder col-7'></span>
                                       <span class='placeholder col-4'></span>
                                       <span class='placeholder col-4'></span>
                                       <span class='placeholder col-6'></span>
                                       <span class='placeholder col-8'></span>
                                   </p>
                                   <a class='btn btn-primary disabled placeholder col-6' aria-disabled='true'></a>
                               </div>
                           </div>
                       </div>";
                            }
                        }
                    }
                    
                    
                }else{
                    echo "
                     <div class='p-2 col-12 col-md-6 col-lg-4 '>
                <div class='card' aria-hidden='true' style='height:100%;'>
                    <img src='...' class='card-img-top' alt='...' style='height:50%' />
                    <div class='card-body'>
                        <h5 class='card-title placeholder-glow'>
                            <span class='placeholder col-6'></span>
                        </h5>
                        <p class='card-text placeholder-glow'>
                            <span class='placeholder col-7'></span>
                            <span class='placeholder col-4'></span>
                            <span class='placeholder col-4'></span>
                            <span class='placeholder col-6'></span>
                            <span class='placeholder col-8'></span>
                        </p>
                        <a class='btn btn-primary disabled placeholder col-6' aria-disabled='true'></a>
                    </div>
                </div>
            </div>";
                }
                ?>



    </div>
    <script src="js/public.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>



</body>