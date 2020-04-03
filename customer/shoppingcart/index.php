<?php
session_start();
include('db.php');
$status = "";
if (isset($_POST['code']) && $_POST['code'] != "") {
	$code = $_POST['code'];
	$result = mysqli_query($con, "SELECT * FROM items WHERE code='$code'");
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$code = $row['code'];
	$price = $row['price'];
	$quantity = $row['quantity'];
	$image = $row['image'];

	$cartArray = array(
		$code => array(
			'name' => $name,
			'code' => $code,
			'price' => $price,
			'quantity' => $quantity,
			'image' => $image
		)
	);

	if (empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		$status = "<div class='box'>Product is added to your cart!</div>";
	} else {
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if (in_array($code, $array_keys)) {
			$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
			$status = "<div class='box'>Product is added to your cart!</div>";
		}
	}
}
?>
<html>

<head>
	<title></title>
	<link rel='stylesheet' href='style2.css' type='text/css' media='all' />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="style.css">
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>

	<link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
	<link href="https://fonts.googleapis.com/css?family=Aclonica|Baloo+Bhaijaan|Black+Ops+One|Bowlby+One+SC|Coda+Caption:800|Saira+Stencil+One|Shrikhand&display=swap" rel="stylesheet">
</head>

<body>
	<h1 style="color:white;text-align:center;padding-top:20px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Shopping Cart</h1>
	<nav class="nav">
		<div class="nav-menu flex-row">
			<div class="nav-brand">
				<a href="#" class="LOGIN"><img src="download2.png "></a>
			</div>

			<div>
				<ul class="nav-items">
					<li class="nav-link">
						<a href="http://localhost/final/customer/main.html">
							Home
						</a>
					</li>
					<li class="nav-link">
						<a href="http://localhost/final/customer/logout.php">Logout</a>
					</li>

				</ul>
			</div>
			<div class="social text-gray">
				<a href="#"><i class="fab fa-facebook-square"></i></a>
				<a href="#"><i class="fab fa-instagram"></i></a>
				<a href="#"><i class="fab fa-twitter"></i></a>
				<a href="#"><i class="fab fa-youtube"></i></a>
			</div>
		</div>
	</nav>


	<div style="width:1000px; margin:60 auto;">

		<h2></h2>

		<?php
		if (!empty($_SESSION["shopping_cart"])) {
			$cart_count = count(array_keys($_SESSION["shopping_cart"]));
			?>
			<div class="cart_div">
				<a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
			</div>
		<?php
		}

		$result = mysqli_query($con, "call display");
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=" . $row['code'] . " />
			
			  <div class='name'>" . $row['name'] . "</div>
			  <div class='image' ><img src='" . $row['image'] . "'/></div>
				 <div class='price'>Rs." . $row['price'] . "</div>
				 <div class='quantity'>Quantity:" . $row['quantity'] . "</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
		}
		mysqli_close($con);
		?>

		<div style="clear:both;"></div>

		<div class="message_box" style="margin:10px 0px;">
			<?php echo $status; ?>
		</div>

	</div>
</body>

</html>