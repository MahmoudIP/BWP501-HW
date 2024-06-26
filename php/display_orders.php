<?php
session_start();

if(isset($_SESSION['name']) && $_SERVER["REQUEST_METHOD"] == "POST" ){
    require_once("./config.php");
    $numorders= isset($_POST['numOrders'])?$_POST['numOrders']:0;
//   GROUP_CONCAT(o.id_p) AS id_p,
    $sql="SELECT 
  o.date,
  GROUP_CONCAT(o.price) AS price,
  GROUP_CONCAT(o.count) AS count,
  MAX(o.location) AS location,
  MAX(o.phone) AS phone,
  GROUP_CONCAT(p.imag) AS path,
  GROUP_CONCAT(p.title) AS title
FROM 
  `orders` o
  LEFT JOIN `product` p ON o.id_p = p.id_p
WHERE 
  o.id_u = ?
GROUP BY 
  o.date
ORDER BY 
  o.date DESC";
  $contents=['status'=>'success'];
  $content="";
  $constev=[""=>""];
    $stmt=$con->prepare($sql);
    if($stmt->bind_param("i",$_SESSION['id'])){
        if($stmt->execute()){
            $stmt->store_result();
            $stmt->bind_result($date,$prices,$counts,$location,$phone,$path,$title);
            if($stmt->num_rows()>0){
            while($stmt->fetch()){
        $content=
         "<div class='order_items p-3 text-center'>".
         "<div class='order_items d-md-flex justify-content-evenly algin-items-center text-center m-auto' >".
         "<div class='info-order'>".
         "<label >Datetime:</label>".
         "<p> $date</p> ".
         "<label >Phone:</label>".
         "<p> $phone</p>".
         "<label >Location:</label>".
         "<p> $location</p>".
        "</div>".
         "</div class='text-center ' >".
         "<div  class='row grid gap m-auto  d-flex item-order justify-content-evenly algin-items-center text-center m-auto   '>";
                // $pros=explode(',',$pros);
                $prices=explode(',',$prices);
                $counts=explode(',',$counts);
                $paths=explode(',',$path);
                $titles=explode(',',$title);
                $total=0;
                for ($i = 0; $i < count($titles); $i++) {
                  $content=$content. "<div class='order-item m-auto d-flex text-center-none col-sm-5 col-md-3 col-lg-2' >";
                    $total+=($prices[$i]*$counts[$i]);
                    $content=$content. "<img src='../imgs/".$paths[$i]."' alt='".$titles[$i]."' width='100px' height='100px' >";
                    $content=$content. "<div>
                    <div>Title: " . $titles[$i] . "</div>
                    <div> Price: " . $prices[$i] . "</div>
                    <div> Count: " . $counts[$i] .  "</div>
                    <div>Total :" . ($prices[$i]*$counts[$i]) ."SYP </div>
                    </div>";
                    $content=$content. "</div>";
                  }
                  
                  $content=$content. "</div>";
                  $content=$content. "<h3>Total Price : "." ".$total." " ."  SYP</h3>";
                  $content=$content."</div>";
                  $content=$content. "<hr>";
                  $contentsv[]=$content;
                  if(!$numorders){break;}
                
            }
            $contents["items"]=$contentsv;
        }
            else{

                $contents['status']='fail';
               
            }
           
        }
        $stmt->close();
    }
    else{
      $contents['status']='fail';
      
    }
    echo json_encode($contents);
    $con->close();
}