<!-- Membaca isi form dengan method GET (tanpa validasi dan repopulating isi form) -->

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
  echo $error_nama;
  if (isset($_POST['submit'])) {
    $nama = test_input($_POST['nama']);
    if ($nama == '') {
      $error_nama = "Nama harus diisi";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      $error_nama = "Nama hanya dapat berisi huruf dan spasi";
    }

    $alamat = test_input($_POST['alamat']);
    if ($alamat == '') {
      $error_alamat = "Alamat harus diisi";
    }

    $jenis_kelamin = test_input($_POST['jenis_kelamin']);
    if ($jenis_kelamin == '') {
      $error_jenis_kelamin = "Jenis kelamin harus diisi";
    }

    $email = test_input($_POST['email']);
    if ($email == '') {
      $error_email = "Email harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_email = "Format email tidak benar";
    }

    $kota = $_POST['kota'];
    if ($kota == '' || $kota == 'kota') {
      $error_kota = "Kota harus diisi";
    }

    $minat = $_POST['minat'];
    if (empty($minat)) {
      $error_minat = "Peminatan harus dipilih";
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  <div class="container">
    <h2>User Input</h2>
    <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" maxlength="50" value="<?php if (isset($nama)) {
                                                                                              echo $nama;
                                                                                            } ?>">
        <div class="error"><?php if (isset($error_nama)) echo $error_nama; ?></div>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) {
                                                                                  echo $email;
                                                                                } ?>">
        <div class="error"><?php if (isset($error_email)) echo $error_email; ?></div>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea class="form-control" id="alamat" rows="3" name="alamat">
	<?php if (isset($alamat)) {
    echo $alamat;
  } ?></textarea>
        <div class="error"><?php if (isset($error_alamat)) echo $error_alamat; ?></div>
      </div>
      <div class="form-group">
        <label for="kota">Kota/ Kabupaten:</label>
        <select id="kota" name="kota" class="form-control">
          <option value="Semarang" <?php if (isset($kota) && $kota == "Semarang") echo 'selected="true"'; ?>>Semarang</option>
          <option value="Jakarta" <?php if (isset($kota) && $kota == "Jakarta") echo 'selected="true"'; ?>>Jakarta</option>
          <option value="Bandung" <?php if (isset($kota) && $kota == "Bandung") echo 'selected="true"'; ?>>Bandung</option>
          <option value="Surabaya" <?php if (isset($kota) && $kota == "Surabaya") echo 'selected="true"'; ?>>Surabaya</option>
        </select>
        <div class="error"><?php if (isset($error_kota)) echo $error_kota; ?></div>
      </div>

      <label>Jenis Kelamin:</label>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "pria") echo "checked"; ?>>Pria
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "wanita") echo "checked"; ?>>Wanita
        </label>
      </div>
      <div class="error"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin; ?></div>
      <br>
      <label>Peminatan:</label>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="minat[]" value="coding" <?php if (isset($minat) && in_array('coding', $minat)) echo 'checked'; ?>>Coding
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="minat[]" value="ux_design" <?php if (isset($minat) && in_array('ux_design', $minat)) echo 'checked'; ?>>UX Design
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="minat[]" value="data_science" <?php if (isset($minat) && in_array('data_science', $minat)) echo 'checked'; ?>>Data Science
        </label>
      </div>
      <div class="error"><?php if (isset($error_minat)) echo $error_minat; ?></div>
      <br>
      <!-- submit, reset dan button -->
      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
      <button type="reset" class="btn btn-danger" value="reset">Reset</button>
    </form>
    <br>
    <?php
    if (isset($_POST["submit"])) {
      echo "<h3>Your Input:</h3>";
      echo 'Nama = ' . $_POST['nama'] . '<br />';
      echo 'Email = ' . $_POST['email'] . '<br />';
      echo 'Alamat = ' . $_POST['alamat'] . '<br />';
      echo 'Kota = ' . $_POST['kota'] . '<br />';
      echo 'Jenis Kelamin = ' . $_POST['jenis_kelamin'] . '<br />';
      $minat = $_POST['minat'];
      if (!empty($minat)) {
        echo 'Peminatan yang dipilih: ';
        foreach ($minat as $minat_item) {
          echo '<br />' . $minat_item;
        }
      }
    }
    ?>
  </div>
</body>

</html>