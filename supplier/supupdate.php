<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "rdbms";

// Create connection
$con = mysqli_connect($server,$user,$pass,$dbname);
session_start();
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$email=$_SESSION["email"];
$query = "SELECT * FROM supplier 
          WHERE email='$email'";
$result = mysqli_query($con,$query) or die(mysql_error());
$row = $result->fetch_assoc();
$supid= $row["suppid"];

$date=date("Y/m/d");
$itemid = $_POST['itemid'];
$q = $_POST['quantity'];

$query1 = "INSERT INTO supplied (suppid,itemid,quantity,supplydate)
VALUES ('$supid','$itemid','$q','$date')";

$query2 = "UPDATE items SET quantity = quantity + '$q'
WHERE itemid = '$itemid'";

if (($con->query($query1) === TRUE)&&($con->query($query2) === TRUE)) {
    header("Location:http://localhost/final/supplier/supplydone.html"); 
            }
else{
        echo "Sorry, we are unable to process your supply.";
}
?>