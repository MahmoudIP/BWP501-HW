<?php
session_start();
require_once('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
$result=['status' => 'Fail'];
    if(isset($_POST['phoneNumber']) && isset($_POST['location']) ){
        $result['status']="success";

        $phone=$_POST['phoneNumber'];
        $location=$_POST['location'];

        $cart=$_COOKIE[$_SESSION['name']]['cart'];
        
        $sql_insert="INSERT INTO `orders`(`id_u`, `id_p`, `count`, `price`, `location`, `phone`, `date`) VALUES (?, ?, ?, ?,?,?,?)";
        $sql_query="SELECT price,stock FROM `product` WHERE id_p =";
        $sql_update="UPDATE `product` SET `stock` = `stock`- ?  WHERE (`id_p` = ? )";
        
        $status=true;
        $prices=[""=>""];

        foreach($cart as $pro=>$count){
            if($stmt=$con->prepare($sql_query."$pro")){
                if($stmt->execute()){
                    $stmt->store_result();
                    $stmt->bind_result($price,$stock);
                    while($stmt->fetch()){
                        if($stock > $count){
                            $result[$pro]="Fail";
                            $prices[$pro]=$price;
                            // break;
                        }else{
                            $status= true;
                            $prices[$pro]=$price;
                            $result[$pro]="true";
                        }
                    }
                    
                }
            }
        }
        if($status){
            $day=date("y-m-d H:i");
            foreach($cart as $pro=> $count ){
                if($stmt=$con->prepare($sql_update)){
                   $stmt->bind_param("ii",$count,$pro);
                   if($stmt->execute()){
                       if($stmt=$con->prepare($sql_insert)){
                           $id_user=(int)$_SESSION['id'];
                           $price=(double)$prices[$pro];
                           $qty=(int)$count;
                           $id_pro=(int)$pro;
                           $stmt->bind_param("iiidsss",$id_user,$id_pro,$qty,$price,$location,$phone,$day);
                           if($stmt->execute()){
                               $result[$pro]="success";
                               setcookie($_SESSION['name']."[cart][$id_pro]",0,time(),"/");
                               // $stmt->error
                           }else{
                               $result['status']="fail";
                               $result[$pro]="fail";
                               $result=$stmt->error;
                           }
                       }  
                   } 
                }
            }
            $stmt->close();
            $con->close();
            echo json_encode($result);
        }else{
            $stmt->close();
            $con->close();
            $result['status']="fail";
            echo json_encode($result);
        }
    }
    
    
}
else header("location: products.php");
die();




// $sql_insert="INSERT INTO `deepspace`.`oreders` (`id_u`, `id_p`, `count`, `price`, `location`, `phone`) VALUES ('1', '1', '3', '200', 'asdsa', 'dasd');"
?>