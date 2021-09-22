<?php
//File 		: show_cart.php
//Deskripsi	: untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

session_start();
$id = $_GET['id'];
if($id != ""){
	//jika $_SESSION['cart'] belum ada, maka inisialisasi dengan array kosong
	//$_SESSION['cart'] merupakan array assosiatif
	//indeksnya berisi isbn buku yang dipilih
	//value-nya berisi jumlah (qty) dari buku dengan isbn tersebut
	if (!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	//jika $_SESSION['cart'] dengan indeks isbn buku yang dipilih sudah ada, tambahkan value-nya dengan 1, jika belum ada, buat elemen baru dengan indeks tersebut dan set nilainya dengan 1
	if (isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]++;
	}else{
		$_SESSION['cart'][$id] = 1;
	}
}
?>
<!-- Menampilkan isi shopping cart -->
<?php include('../header.html') ?>
<br>
<div class="card">
<div class="card-header">Shopping Cart</div>
<div class="card-body">
<br>
<table class="table table-striped">
    <tr>
		<th>ISBN</th>
		<th>Qty</th>
	</tr>
<?php
$sum_qty = 0; //inisialisasi total item di shopping cart
if (is_array($_SESSION['cart'])){
	foreach ($_SESSION['cart'] as $id => $qty){
		echo '<tr>';
		echo '<td>'.$id.'</td>';
		echo '<td>'.$qty.'</td>';
		echo '</tr>';
		$sum_qty = $sum_qty + $qty;
	}
	echo'<tr><td></td><td>'.$sum_qty.'</td></tr>';
}else{
	echo '<tr><td colspan="2" align="center">There is no item in shopping cart</td></tr>';
}
?>
</table>
Total items = <?php echo $sum_qty; ?><br><br>
<a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
<a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br /><br />
</div>
</div>
<?php include('../footer.html') ?>