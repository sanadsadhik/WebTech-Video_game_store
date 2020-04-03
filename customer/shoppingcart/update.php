<?php
include('db.php');
session_start();

$date=date("Y/m/d");
$totalprice = $_SESSION['totalprice'];
$email = $_SESSION['email'];



$query = "SELECT * FROM customer 
          WHERE email='$email'";
$result = mysqli_query($con,$query) or die(mysql_error());
$row = $result->fetch_assoc();
$cid = $row["cid"];


$query = "INSERT INTO orders (cid, purchasedate, totalprice)
VALUES ('$cid','$date','$totalprice')";

if ($con->query($query) === TRUE) {
    echo "PURCHASE SUCCESFUL";
}   

foreach ($_SESSION["shopping_cart"] as $product)
{
    $c=$product["code"];
    $q=$product["quantity"];
   
    $query = "UPDATE items
    SET quantity = quantity - '$q' 
    WHERE code = '$c'";
     if ($con->query($query) === TRUE) {
        header("Location:http://localhost/final/customer/purchasedone.html");
                }
    else{
            echo  mysqli_error($query);
    }
 
}

session_destroy();

?>