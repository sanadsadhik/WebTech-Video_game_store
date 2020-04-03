<?php


$server = "localhost";
$user = "root";
$pass = "";
$dbname = "rdbms";
session_start();
// Create connection
$conn = mysqli_connect($server,$user,$pass,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['pass'];
$_SESSION['email'] = $email;

$query1 = "SELECT * FROM customer 
          WHERE email='$email' and pass='$pass'";
$result1 = mysqli_query($conn,$query1) or die(mysql_error());
$rows1 = mysqli_num_rows($result1);
$query2 = "SELECT * FROM supplier 
          WHERE email='$email' and pass='$pass'";
$result2 = mysqli_query($conn,$query2) or die(mysql_error());
$rows2 = mysqli_num_rows($result2);
if($rows1==1){
        header("Location:http://localhost/final/customer/main.html");
}
else if($rows2==1){
    header("Location:http://localhost/final/supplier/sup.php");
}
else{
    header("Location:loginfail.html");
}

$conn->close();
?>
