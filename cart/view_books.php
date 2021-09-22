<!-- File: view_books.php
	Deskripsi : menampilkan data buku dan link untuk menambah item ke shopping cart
-->
<?php include('../header.html') ?>
<br>
<div class="card">
<div class="card-header">Books Data</div>
<div class="card-body">
<br>
<table class="table table-striped">
    <tr>
		<th>ISBN</th>
		<th>Author</th>
        <th>Title</th>
		<th>Price</th>
		<th>Action</th>
	</tr>
<?php
// Include our login information
require_once('../lib/db_login.php');
//Asign a query
$query = " SELECT * FROM books ";
$result = $db->query($query);
if (!$result){
   die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
}
// Fetch and display the results
while ($row = $result->fetch_object()){
	echo '<tr>';
    echo '<td>'.$row->isbn.'</td>';
    echo '<td>'.$row->author.'</td> ';
	echo '<td>'.$row->title.'</td> ';
    echo '<td> $'.$row->price.'</td>';
	echo '<td><a class="btn btn-primary" href="show_cart.php?id='.$row->isbn.'">Add to Cart</a></td>';
	echo '</tr>';
}
echo '</table>';
echo '<br />';
echo 'Total Rows = '.$result->num_rows.'<br />';
$result->free();
$db->close();
?>
</table>
</div>
</div>
<?php include('../footer.html') ?>