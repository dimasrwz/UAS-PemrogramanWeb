<?php

include_once("../controller/koneksi.php");

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, md5($_POST["password"]));

$query_sql = "SELECT * FROM user_data
                           WHERE user_email = '$email' && password = '$password'";

$result = mysqli_query($conn, $query_sql);

if (mysqli_num_rows($result) > 0) {
  while ($data = mysqli_fetch_array($result)) {
    $_SESSION['user_id'] = $data['user_id'];
    $nama_user = $data['nama'];
  }
  $_SESSION['sukses'] = "<div class='alert alert-success' role='alert'>
    Selamat datang $nama_user
  </div>";
  header("Location: ../index.php");
} else {
  $_SESSION['gagal'] = "<div class='alert alert-danger' role='alert'>
        email atau password yang anda masukkan salah
      </div>";
  header("Location: ../index.php");
}
