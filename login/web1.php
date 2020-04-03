<?php

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "rdbms";

// Create connection
$conn = mysqli_connect($server,$user,$pass,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])){

$email = $_POST['email'];
$name = $_POST['name'];
$pass = $_POST['pass'];
$address = $_POST['address'];

$sql = "INSERT INTO customer (name,email,pass,address)
VALUES ('$name','$email','$pass','$address')";

if ($conn->query($sql) === TRUE) {
    header("Location:web.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>