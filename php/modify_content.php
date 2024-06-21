<?php
session_start();

if(isset($_SESSION['name'])){

    $name=$_SESSION['name'];
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {   
        
        if($_POST["type_modify"]=="Add"){
            
            $count = isset($_POST['count'])?$_POST['count']:1;

            $productId = $_POST['id'];
            setcookie($name."[cart][$productId]",$count,time()+3600,"/");
            echo json_encode(['status' => 'success', 'message' => 'added']);
            // } else {
                // echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            }else if($_POST["type_modify"]=="Remove"){
                $productId = $_POST['id'];
                setcookie($name."[cart][$productId]",0,time(),"/");
                // unset($_COOKIE["cart"][$productId]);
                echo json_encode(['status' => 'success', 'message' => 'removed']);
            }
        }
    }
else echo json_encode(['status' => 'success', 'message' => 'Login To Add']);

die();
?>