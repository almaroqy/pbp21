<?php
require_once('../lib/db_login.php');
$valid = TRUE;
if (isset($_POST["submit"])) {
	$name = test_input($_POST['name']);
	if ($name == '') {
		$error_name = "Name is required";
		$valid = FALSE;
	} else {
		if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
			$error_name = "Only letters and white space allowed";
			$valid = FALSE;
		}
	}

	$address = test_input($_POST['address']);
	if ($address == '') {
		$error_address = "Address is required";
		$valid = FALSE;
	}

	$city = $_POST['city'];
	if ($city == '' || $city == 'none') {
		$error_city = "City is required";
		$valid = FALSE;
	}

	//insert data into database
	if ($valid) {
		//escape inputs data
		$name = $db->real_escape_string($name);
		$address = $db->real_escape_string($address);
		$city = $db->real_escape_string($city);
		//Asign a query
		$query = " INSERT INTO customers (name, address, city) VALUES('" . $name . "','" . $address . "','" . $city . "') ";
		// Execute the query
		$result = $db->query($query);
		if (!$result) {
			die("Could not query the database: <br />" . $db->error . 'query = ' . $query);
		} else {
			header('Location: view_customer.php');
		}
		//close db connection
		$db->close();
	}
}
?>
<?php include('../header.html') ?>
<br>
<div class="card">
	<div class="card-header">Add Customers Data</div>
	<div class="card-body">
		<br>
		<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label for="name">Nama:</label>
				<input type="text" class="form-control" id="name" name="name" maxlength="50" value="<?php echo $name; ?>">
				<div class="error"><?php if (isset($error_name)) echo $error_name; ?></div>
			</div>
			<div class="form-group">
				<label for="address">Address:</label>
				<textarea class="form-control" id="address" name="address" rows="5" cols="30" placeholder="Address (max 100 characters)"><?php echo $address; ?></textarea>
				<div class="error"><?php if (isset($error_address)) echo $error_address; ?></div>
			</div>
			<div class="form-group">
				<label for="city">City:</label>
				<select name="city" id="city" class="form-control" required>
					<option value="none" <?php if (!isset($city)) echo 'selected="true"'; ?>>--Select a city--</option>
					<option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected="true"'; ?>>Airport West</option>
					<option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected="true"'; ?>>Box Hill</option>
					<option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected="true"'; ?>>Yarraville</option>
				</select>
				<div class="error"><?php if (isset($error_city)) echo $error_city; ?></div>
			</div>
			<br>
			<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>&nbsp;
			<a href="view_customer.php" class="btn btn-secondary">Cancel</a>
		</form>
	</div>
</div>
<?php include('../footer.html') ?>