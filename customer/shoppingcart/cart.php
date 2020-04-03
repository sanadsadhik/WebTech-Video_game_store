<?php
include('db.php');
session_start();
$status = "";
if (isset($_POST['action']) && $_POST['action'] == "remove") {
	if (!empty($_SESSION["shopping_cart"])) {
		foreach ($_SESSION["shopping_cart"] as $key => $value) {
			if ($_POST["code"] == $key) {
				unset($_SESSION["shopping_cart"][$key]);
				$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
			}
			if (empty($_SESSION["shopping_cart"]))
				unset($_SESSION["shopping_cart"]);
		}
	}
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
	foreach ($_SESSION["shopping_cart"] as &$value) {
		if ($value['code'] === $_POST["code"]) {
			$value['quantity'] = $_POST["quantity"];
			break; // Stop the loop after we've found the product
		}
	}
}
?>
<html>

<head>
	<title>CART</title>
	<link rel='stylesheet' href='style2.css' type='text/css' media='all' />
</head>

<body>
	<div style="width:1000px!important ; margin:60 auto;>

		<h2>Your Cart</h2>

		<?php
		if (!empty($_SESSION["shopping_cart"])) {
			$cart_count = count(array_keys($_SESSION["shopping_cart"]));
			?>
			<div class=" cart_div">
		<a href="index.php">
			<img src="cart-icon.png" /> Cart
			<span><?php echo $cart_count; ?></span></a>
	</div>
<?php
}
?>

<div class="cart">
	<?php
	if (isset($_SESSION["shopping_cart"])) {
		$total_price = 0;
		?>
		<table class="table">
			<tbody>
				<tr>
					<td>ITEM NAME</td>
					<td>QUANTITY</td>
					<td>UNIT PRICE</td>
					<td>ITEMS TOTAL</td>
				</tr>
				<?php
					foreach ($_SESSION["shopping_cart"] as $product) {
						?>
					<tr>

						<td><?php echo $product["name"]; ?><br />
							<form method='post' action=''>
								<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
								<input type='hidden' name='action' value="remove" />
								<button type='submit' class='remove'>Remove Item</button>
							</form>
						</td>
						<td>
							<form method='post' action=''>
								<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
								<input type='hidden' name='action' value="change" />
								<select name='quantity' class='quantity' onchange="this.form.submit()">
									<option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1" selected>1</option>
									<option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
									<option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
									<option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
									<option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
								</select>
							</form>



						</td>
						<td><?php echo "Rs." . $product["price"]; ?></td>
						<td><?php echo "Rs." . $product["price"] * $product["quantity"];
									$product["quantity"] = 0 + $product["quantity"] ?></td>
					</tr>
				<?php
						$total_price += ($product["price"] * $product["quantity"]);
						$_SESSION['totalprice'] = $total_price;
					}
					?>



				<tr>
					<td colspan="5" align="right">
						<strong>TOTAL: <?php echo "$" . $total_price; ?></strong>
					</td>
				</tr>
			</tbody>
		</table>


		<div class="buy_div">
			<a href="update.php">
				<img src="cart-icon.png" /> BUY
		</div>


	<?php
	} else {
		echo "<h3>Your cart is empty!</h3>";
	}
	?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
	<?php echo $status; ?>
</div>


<br /><br />

</div>
</body>

</html>