<!--File		: view_customer.php
	Deskripsi	: menampilkan data customers
-->
<?php include('../header.html') ?>
<br>
<div class="card">
	<div class="card-header">Customers Data</div>
	<div class="card-body">
		<br>
		<a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a><br /><br />
		<table class="table table-striped">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Address</th>
				<th>City</th>
				<th>Action</th>
			</tr>

			<?php
			// Include our login information
			require_once('../lib/db_login.php');
			// Execute the query
			$result = $db->query(" SELECT * FROM customers ORDER BY customerid ");
			if (!$result) {
				die("Could not query the database: <br />" . $db->error);
			}
			// Fetch and display the results
			$i = 1;
			while ($row = $result->fetch_object()) {
				echo '<tr>';
				echo '<td>' . $i . '</td>';
				echo '<td>' . $row->name . '</td> ';
				echo '<td>' . $row->address . '</td> ';
				echo '<td>' . $row->city . '</td>';
				echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->customerid . '">Edit</a>&nbsp;&nbsp; 
			<a class="btn btn-danger btn-sm" href="confirm_delete_customer.php?id=' . $row->customerid . '">Delete</a>
			</td>';
				echo '</tr>';
				$i++;
			}
			echo '</table>';
			echo '<br />';
			echo 'Total Rows = ' . $result->num_rows;
			$result->free();
			$db->close();

			?>
		</table>
	</div>
</div>
<?php include('../footer.html') ?>