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

</head>

<?php
function print_product($id_p,$title,$price,$path,$stock,$val){
echo "
<div class='items d-sm-flex text-center col-md-12'>
                <div class='buttons butn-delete col-md-1'>

                    <i class='fa-solid fa-xmark'></i>
                </div>
                <div class='image col-md-3'>
                    <img class='image' src='../imgs/$path' alt='$title' />
</div>
<div class='description col-md-7 d-sm-flex  justify-content-between align-items-center'>
    <span class='col-md-4'>
        <h4> $title</h4>
        <h5 name='price' price='$price'>Price:$price</h5>
        <h5 name='stock' stock='$stock'>stock:  $stock </h5>
    </span>
    <div class='quantity col-md-5 align-items-center'>

        <button class='plus-btn btns ' type='button' name='button'>
            <i class='fa-solid fa-plus'></i> </button>
        <input type='text' class='count text-center'  value='$val' readonly> SYP
        <button class='minus-btn btns' type='button' name='button'>
            <i class='fa-solid fa-minus'></i>
        </button>
    </div>
    <div class='price-content col-md-3 align-items-center'>
        <label class='p  rice fs-5 '>Total :</label><br>
        <input type='text' class='cost price text-center mb-4' readonly> 
    </div>
    <label class='id_p d-none' id_p='$id_p'></label>
</div>
</div>" ;
}
?>



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
                <ul class="col-8 col-lg-6 d-block d-md-flex justify-content-between " id="navbar-but">
                    <li class="ms-3 "><a href="../index.php">Home</a></li>
                    <li class="ms-3 "><a href="./products.php">Products</a></li>
                    <li class="ms-3 active"><a href="./orders.php"><i class="fa-solid fa-cart-shopping"></i>Cart </a>
                    </li>
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
        <div class="shopping-cart pb-1">
            <!-- Title -->
            <h2 class="title title p-3 text-center">
                Shopping Bag
            </h2>
            <?php 
        require_once("./config.php");
        if(isset($_SESSION['name'])){
            if(isset($_COOKIE[$username]['cart'])){

                foreach($_COOKIE[$username]['cart'] as $key => $val){
                    $sql = "SELECT title,price,imag,stock FROM `product` WHERE id_p = ? ";
                    if($stmt = $con->prepare($sql)){
                        $stmt->bind_param("i",$key);
                        if($stmt->execute()){
                            $stmt->store_result();
                            $stmt->bind_result($title,$price,$path,$stock);
                            while($stmt->fetch()){
                                print_product($key,$title,$price,$path,$stock,$val);
                            }  
                        }
                    } 
                } //end foreach
            }
        }
            ?>
        </div>
    </div>


    <!--if the cart id empty  -->
    <div
        class="content container mt-2  cart-impty <?php echo isset($_SESSION['name'])? (isset($_COOKIE[$username]['cart']) ?"d-none":''):'d-none' ?>">
        <div class='item d-block text-center col-md-12 p-3'>
            <p class="fs-2">Cart Empty!</p>
            <div class="justify-content-center algin-items-center cart-font ">
                <i class="fa-solid fa-cart-plus "></i>
            </div>
            <a href="./products.php" class="btn  btn-add-product">Add Products?!</a>
        </div>
    </div>

    <!--  if the user doesn't login -->
    <?php if(!isset($_SESSION['name'])){ ?>
    <div class="content container">
        <div class='item d-block text-center col-md-12 p-3 mt-2'>
            <p class="fs-2">You don't have a cart! </p>
            <p class="fs-3">Please login and try agin </p>
            <div class="justify-content-center algin-items-center cart-font ">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <a href="./login.php" class="btn btn-primary">Login</a>
        </div>
    </div>
    <?php } // user didn't logon ?>


    </div>

    <?php if(!empty($username)){ ?>
    <div class="content container mt-2 mb-4">
        <div class="payment">
            <div class="d-md-flex shopping-cart p-3 justify-content-center algin-items-center m-auto">
                <div class="shopping-cart p-3 ">
                    <!-- Title -->
                    <h2 class="title title p-3 text-center">
                        Total Price
                    </h2>
                    <div class="text-center">
                        <input type="text" class="text-center" id="total-price" readonly>
                    </div>
                    <div class="text-center p-5">
                        <a href="./products.php" class="btn btn-add-product">Add Products?!</a> <br>OR<br>
                        <button class="btn checkout">CheckOut</button>
                    </div>
                </div>
                <div class="text-center align-content-center pay  d-none">

                    <div class="info">
                        <label for="location">location: </label><br>
                        <input type="text" name="location" maxlength="60" class="text-center"
                            placeholder="location"><br>
                        <label for="location" name="errorLocation" class="err d-none">Location Is Required</label>
                    </div>
                    <div class="info">
                        <label for="phoneNumber">Phone Number: </label><br>
                        <input type="text" name="phoneNumber" class="text-center " placeholder="09-- --- ---"><br>
                        <label for="phoneNumber" name="errorNumber" class="err d-none">Invaled Phone Number </label><br>

                    </div>
                    <div class="info">
                        <button class="btn btn-primary m-3 order" id="order">
                            <i class="fa-solid fa-truck-ramp-box"></i> Order Now</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php } // user login 
    if(isset($_SESSION['name'])){?>
    <div class="content container">
        <div class="orders-history pb-1">
            <!-- Title -->
            <h2 class="title title p-3 text-center">
                orders History
            </h2>
            <?php  // display orders;
            if(

                !include_once('./display_orders.php')
            )
            echo"<h1 class='text-center'>No Orders yet </h1>";
    }
?>
        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let cartButtons = document.querySelectorAll(".items .butn-delete");
        cartButtons.forEach(butn => {

            let card = butn.closest(".items");
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
                                countTotalPrice();
                                ifCartEmpty()
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
            total.value = (Number(price) * Number(count.value));

            // adding count 
            addButton.addEventListener("click", (e) => {
                if (Number(count.value) < Number(stock)) {
                    count.value = 1 + Number(count.value);
                    modify_cart(count.value);
                    total.value = (Number(price) * Number(count.value));

                } else {
                    count.value = count.value;
                }
                countTotalPrice();

            })
            minusBtn.addEventListener("click", (e) => {
                if (Number(count.value) > 1) {
                    count.value = count.value - 1;
                    modify_cart(count.value);
                    total.value = (Number(price) * Number(count.value));
                } else {
                    count.value = count.value;
                }
                countTotalPrice();

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

        countTotalPrice();
        ifCartEmpty()

        function countTotalPrice() {
            let totals = document.querySelectorAll("input[type='text'].cost");
            let totalPrice = document.getElementById("total-price");
            totalPrice.value = 0
            for (let i = 0; i < totals.length; i++) {
                totalPrice.value = Number(totalPrice.value) + Number(totals[i].value);
            }

        }

        function ifCartEmpty() {

            let items = document.querySelectorAll(".items");
            let payment = document.querySelector(".payment");

            if (items.length < 1) {
                document.querySelector(".cart-impty").classList.remove("d-none");
                payment.classList.add("d-none")
            } else {
                document.querySelector(".cart-impty").classList.add("d-none");
                payment.classList.remove("d-none")
            }

        }

        document.querySelector(".checkout").addEventListener("click", (e) => {
            document.querySelector(".pay").classList.remove("d-none");
            document.getElementById("order").scrollIntoView({
                behavior: 'smooth'
            });
        })
        let phoneNum = document.querySelector("input[name='phoneNumber']");
        let location = document.querySelector("input[name='location']");
        phoneNum.addEventListener("change", checkPhoneNumber);

        function checkPhoneNumber() {
            if (phoneNum.value == null) {
                document.querySelector("[name='errorNumber']").textContent = "Phone Number Is Required"
                document.querySelector("[name='errorNumber']").classList.remove("d-none");
                return false;
            } else
            if (phoneNum.value.search(/^09[0-9]{8}$/) == -1) {
                document.querySelector("[name='errorNumber']").textContent = "Invaled Phone Number"
                phoneNum.value = null;
                document.querySelector("[name='errorNumber']").classList.remove("d-none");
                phoneNum.focus();
                return false;
            } else {
                document.querySelector("[name='errorNumber']").classList.add("d-none");
                return true;
            }
        }

        function checkinputs() {
            if (location.value.trim() === "") {
                document.querySelector("[name='errorLocation']").textContent = "Location Is Required";
                document.querySelector("[name='errorLocation']").classList.remove("d-none");
                return checkPhoneNumber() && false;
            } else if (location.value.trim().length < 3) {
                document.querySelector("[name='errorLocation']").textContent =
                    "Invalid Location at lest 3 charcater";
                document.querySelector("[name='errorLocation']").classList.remove("d-none");
                return checkPhoneNumber() && false;
            } else {
                document.querySelector("[name='errorLocation']").classList.add("d-none");
                return checkPhoneNumber() && true;
            }
        }

        // let cards = document.querySelectorAll('.items');
        // cards.forEach(el => {
        //     el.remove();
        // });

        document.getElementById("order").addEventListener("click", (e) => {
            if (checkinputs()) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "./submit_order.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.status == "success") {
                            document.querySelectorAll('.items').forEach(el => {
                                el.remove();
                            })
                            countTotalPrice();
                        } else {
                            console.log(response.message);
                        }
                    }
                };
                xhr.send("phoneNumber=" + phoneNum.value + "&location=" + location.value.trim());
            }
        })

    });
    </script>
    <script src="../js/public.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js.map"></script>


</body>