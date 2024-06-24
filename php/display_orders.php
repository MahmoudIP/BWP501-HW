<?php
// session_start();

if(isset($_SESSION['name'])){
    require_once("./config.php");
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
    $stmt=$con->prepare($sql);
    if($stmt->bind_param("i",$_SESSION['id'])){
        if($stmt->execute()){
            $stmt->store_result();
            $stmt->bind_result($date,$prices,$counts,$location,$phone,$path,$title);
            if($stmt->num_rows()>0)
            while($stmt->fetch()){
        echo "<div class='order_items p-3 text-center'>";
        echo "<div class='order_items d-md-flex justify-content-evenly algin-items-center text-center m-auto' >";
        echo "<div class='info-order'>";
        echo "<label >Datetime:</label>";
        echo "<p> $date</p> ";
        echo "<label >Phone:</label>";
        echo "<p> $phone</p>";
        echo "<label >Location:</label>";
        echo "<p> $location</p>";
        echo"</div>";
        // echo "<h3>Items:</h3>";
        echo "</div class='text-center ' >";
        echo "<div  class='row grid gap m-auto  d-flex item-order justify-content-evenly algin-items-center text-center m-auto   '>";
                // $pros=explode(',',$pros);
                $prices=explode(',',$prices);
                $counts=explode(',',$counts);
                $paths=explode(',',$path);
                $titles=explode(',',$title);
                $total=0;
                for ($i = 0; $i < count($titles); $i++) {
                    echo "<div class='order-item m-auto d-flex text-center-none col-sm-5 col-md-3 col-lg-2' >";
                    $total+=($prices[$i]*$counts[$i]);
                    echo "<img src='../imgs/".$paths[$i]."' alt='".$titles[$i]."' width='100px' height='100px' >";
                    echo "<div>
                    <div>Title: " . $titles[$i] . "</div>
                    <div> Price: " . $prices[$i] . "</div>
                    <div> Count: " . $counts[$i] .  "</div>
                    <div>Total :" . ($prices[$i]*$counts[$i]) ."SYP </div>
                    </div>";
                    echo "</div>";
                }

                echo "</div>";
                echo "<h3>Total Price : "." ".$total." " ."  SYP</h3>";
                echo"</div>";
                echo "<hr>";
            }
            else{
                $stmt->close();
                $con->close();
                return null;
            }
        }
        $stmt->close();
    }
    $con->close();
}