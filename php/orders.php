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
            <h2 class="title title p-3 text-center">
                Shopping Bag
            </h2>
            <span class="d-sm-none total-cart-price">
                <label id="total-cart">Total Cart</label><br>
            </span>
            <?php 
        require_once("./config.php");
            foreach($_COOKIE[$username]['cart'] as $key => $val){
                $sql = "SELECT id_p,title,price,imag,stock FROM `product` WHERE id_p = ? ";
                if($stmt = $con->prepare($sql)){
                    $stmt->bind_param("i",$key);
                    if($stmt->execute()){
                        $stmt->store_result();
                        $stmt->bind_result($id_p,$title,$price,$path,$stock);
                        while($stmt->fetch()){
                            ?>
            <!-- Product #1 -->
            <div class='item d-sm-flex text-center col-md-12'>
                <div class='buttons butn-delete col-md-1'>

                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class='image col-md-3'>
                    <img class='image' src='../imgs/<?php echo $path?>' alt='$title' />
                </div>
                <div class='description col-md-7 d-sm-flex  justify-content-between align-items-center'>
                    <span class="col-md-4">
                        <h4><?php echo $title ?></h4>
                        <h5 name="price" price="<?php echo $price?>">Price: <?php echo $price."$" ?></h5>
                        <h5 name="stock" stock="<?php echo $stock ?>">stock: <?php echo $stock ?></h5>
                    </span>
                    <div class='quantity col-md-5 align-items-center'>
                        <button class='plus-btn btns' type='button' name='button'>
                            <i class="fa-solid fa-plus"></i> </button>
                        <input type='text' class="count text-center" name='name' value="1" readonly>
                        <button class='minus-btn btns' type='button' name='button'>
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                    <div class="price-content col-md-3 align-items-center">
                        <label class="p  rice fs-5 ">Total :</label><br>
                        <input type='text' class="cost price text-center mb-4" readonly>
                    </div>
                    <label class="id_p d-none" id_p="<?php echo $id_p ?>"></label>
                </div>
            </div>
            <?php
            }//end foreach
                } ?>

            <?php
            }
           }
           ?>

        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let cartButtons = document.querySelectorAll(".item  .butn-delete");
        cartButtons.forEach(butn => {
            let card = butn.closest(".item");
            let id = card.querySelector(".id_p").getAttribute("id_p");
            butn.addEventListener("click", (e) => {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "./modify_content.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.status == "success") {
                            if (response.message == "removed") {
                                card.remove();
                            }
                        } else {
                            console.log(response.message);
                        }
                    }
                };
                xhr.send("id=" + id + "&type_modify=Remove");
            })
            let addButton = card.querySelector(".quantity .plus-btn");
            let minusBtn = card.querySelector(".quantity .minus-btn");
            let count = card.querySelector("input.count");
            let stock = card.querySelector("[name='stock']").getAttribute("stock");
            let price = card.querySelector("[name='price']").getAttribute("price");
            let total = card.querySelector("input[type='text'].cost");
            total.value = Number(price) * Number(count.value);
            addButton.addEventListener("click", (e) => {
                if (Number(count.value) < Number(stock)) {
                    count.value = 1 + Number(count.value);
                    modify_cart(count.value);
                    total.value = Number(price) * Number(count.value);

                } else {
                    count.value = count.value;
                }

            })
            minusBtn.addEventListener("click", (e) => {
                if (Number(count.value) > 1) {
                    count.value = count.value - 1;
                    modify_cart(count.value);
                    total.value = Number(price) * Number(count.value);
                } else {
                    count.value = count.value;
                }
            })

            function modify_cart(count) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "./modify_content.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.status == "success") {
                            if (response.message == "removed") {
                                card.remove();
                            }
                        } else {
                            console.log(response.message);
                        }
                    }
                };
                xhr.send("id=" + id + "&type_modify=Add" + "&count=" + count);
            }



        });
    });
    </script>
    <script src="../js/public.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>


</body>