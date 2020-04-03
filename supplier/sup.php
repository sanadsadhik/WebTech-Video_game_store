<?php
$con = mysqli_connect("localhost","root","","rdbms");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
        }
        session_start(); 
        $email=$_SESSION["email"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>supply</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1|Noto+Sans+HK|PT+Sans+Caption&display=swap"
        rel="stylesheet">
    <style>
        .center {
            margin: auto;
            width: 60%;
            padding: 10px;
            padding-left: 739px px;
            padding-top: 20px;
        }
    </style>
    <style>
        table {
            font-family: 'Gothic A1', sans-serif;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid white;

        }

        td {

            text-align: left;
            padding: 14px;
            background-color: black;
            border: 2px solid white !important;
            margin: 0 30px !important;

        }

        th {
            margin: 0 30px!important;
            text-align: left;
            padding: 14px;
            background-color: black;
            border: 2px solid white !important;


        }
    </style>
</head>

<body>

    <div class="top">
        <h1 style="text-align:center;color:white;font-family: 'PT Sans Caption', sans-serif">Supplier</h1>
    </div>
    <div class="side"><a href="http://localhost/final/login/web.html">Logout</a></div>

    <div class="sup-box">


        <div class="textbox">
            <i class="fa fa-envelope fa-2x" aria-hidden="true" style="color:white;"></i>
            <h3 style="color:white;font-family: 'Noto Sans HK', sans-serif;"> SUPPLIER EMAIL : <?php echo $email?>
            </h3>
        </div>
        <form id="supply" action="supupdate.php" method="POST" class="input-group">
            <fieldset style="height:200px">
                <legend style="color:white;">
                    <h2>Enter Details</h2>
                </legend>

                <div class="textbox" id="in1" style="color:white;">
                   ItemID:<input style="background-color:gray;padding:10px;color:black!important;padding-left:5px;" type="text" name="itemid" class="input-field" placeholder="Enter ItemId" required>
                </div>
                <div class="textbox " id="in2" style="color:white;">
                    Quantity:<input type="text" name="quantity" class="input-field " placeholder="Enter quantity" required style="background-color:gray;padding:10px;">
                </div>
                <div class="button">
                    <button type="submit" class="submit-btn button1" style="padding-left:10px;">SUBMIT</button>

                </div>
        </form>

        </fieldset>
        <table style="padding:5px;margin-top:30px;">
            <thead>
                <th style="color:white;">Itemid</th>
                <th style="color:white;">Quantity</th>
                <th style="color:white;">Supply Date</th>
            </thead>
            <?php 


$result = mysqli_query($con,"SELECT * FROM supplied ss,supplier s WHERE ss.suppid=s.suppid AND s.email='$email' "); 
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["itemid"];
        $field2name = $row["quantity"];
        $field3name = $row["supplydate"]; 
 
        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td>  
              </tr>';
    }
?>
        </table>
</body>

</html>