<!-- Membaca isi form dengan method GET (menggunakan validasi, tanpa repopulating isi form) -->

<!DOCTYPE HTML> 
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../css/bootstrap-4.5.2-dist/css/bootstrap.min.css">
  <!-- Own CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- jQuery library -->
  <script src="../css/bootstrap-4.5.2-dist/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="../css/bootstrap-4.5.2-dist/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="../css/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
  <title>Form</title>
</head>
<body>
<?php
if (isset($_POST['submit'])){
	//validasi nama: tidak boleh kosong, hanya dapat berisi huruf dan spasi
	$nama = test_input($_POST['nama']);
	if (empty($nama)){
		$error_nama = "Nama harus diisi";
	}elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
       $error_nama = "Nama hanya dapat berisi huruf dan spasi";
	}
	//validasi email: tidak boleh kosong, format harus benar
	$email = test_input($_POST['email']);
	if ($email == ''){
		$error_email = "Email harus diisi";
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error_email = "Format email tidak benar";
	}
	//validasi alamat: tidak boleh kosong
	$alamat = test_input($_POST['alamat']);
	if ($alamat == ''){
		$error_alamat = "Alamat harus diisi";
	}
	//validasijenis kelamin: tidak boleh kosong
	if ($jenis_kelamin == ''){
		$error_jenis_kelamin = "Jenis kelamin harus diisi";
	}
	//validasi kota: tidak boleh kosong
	$kota = $_POST['kota'];
	if ($kota == '' || $kota == 'kota'){
		$error_kota = "Kota harus diisi";
	}
	//validasi minat: tidak boleh kosong
	$minat= $_POST['minat'];
	if (empty($minat)){
		$error_minat = "Peminatan harus dipilih";
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?> 
<div class="container">
<div class="card">
<div class="card-header">Form Mahasiswa</div>
<div class="card-body">
<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="form-group">
	<label for="nama">Nama:</label>
	<input type="text" class="form-control" id="nama" name="nama" maxlength="50">
	<div class="error"><?php if(isset($error_nama)) echo $error_nama;?></div>
  </div>
  <div class="form-group">
	<label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email">
	<div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat:</label>
    <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
	<div class="error"><?php if(isset($error_alamat)) echo $error_alamat;?></div>
  </div>
  <div class="form-group">
	<label for="kota">Kota/ Kabupaten:</label>
	<select id="kota" name="kota" class="form-control">
		<option value="Semarang">Semarang</option>
		<option value="Jakarta">Jakarta</option>
		<option value="Bandung">Bandung</option>
		<option value="Surabaya">Surabaya</option>
	</select>
	<div class="error"><?php if(isset($error_kota)) echo $error_kota;?></div>
  </div>
  
  <label>Jenis Kelamin:</label>
  <div class="form-check">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria">Pria
    </label>
  </div>
  <div class="form-check">
    <label class="form-check-label">
      <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita">Wanita
    </label>
  </div>
  <div class="error"><?php if(isset($error_jenis_kelamin)) echo $error_jenis_kelamin;?></div>
  <br>
  <label>Peminatan:</label>
  <div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="minat[]" value="coding">Coding
  </label>
  </div>
  <div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="minat[]" value="ux_design">UX Design
  </label>
  </div>
  <div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="minat[]" value="data_science">Data Science
  </label>
  </div>
  <div class="error"><?php if(isset($error_minat)) echo $error_minat;?></div>
  <br>
  <!-- submit, reset dan button -->
  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
  <button type="reset" class="btn btn-danger">Reset</button>
</form>
<br>
<?php
if (isset($_POST["submit"])){
	echo "<h3>Your Input:</h3>";
	echo 'Nama = '.$_POST['nama'].'<br />';
	echo 'Email = '.$_POST['email'].'<br />';
	echo 'Kota = '.$_POST['kota'].'<br />';
	echo 'Jenis Kelamin = '.$_POST['jenis_kelamin'].'<br />';
	$minat = $_POST['minat'];
	if (!empty($minat)){
		echo 'Peminatan yang dipilih: ';
		foreach($minat as $minat_item){
		   echo '<br />'.$minat_item;
		}
	}
}
?>
</div>
</div>
</div>
</body>
</html>

