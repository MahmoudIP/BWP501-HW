<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $quantity = $_POST['quantity'];
            if($_POST["type_modify"]=="Add" &&$quantity>0){

                $productId = $_POST['id'];
                setcookie("cart[$productId]",$quantity,time()+3600,"/");
                //  $quantity;
                
                
                echo json_encode(['status' => 'success', 'message' => 'added',"count"=>$quantity]);
                // } else {
                // echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            }else if($_POST["type_modify"]=="Remove" || $quantity ==0){
                $productId = $_POST['id'];
                setcookie("cart[$productId]",0,time(),"/");
                // unset($_COOKIE["cart"][$productId]);
                echo json_encode(['status' => 'success', 'message' => 'removed',"count"=>$quantity]);
                }
}
else header("location: products.php");
die();
?>