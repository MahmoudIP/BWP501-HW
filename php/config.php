<?php
// config.php
$host="localhost";
$port=3306;
// $socket="";
$user="root";
$password="1234";
$dbname="deepspace";

$con = new mysqli($host, $user, $password, $dbname,$port)
	or die ('Could not connect to the database server' . mysqli_connect_error());