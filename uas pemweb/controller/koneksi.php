<?php
ob_start();

/* nama server kita */
$servername = "localhost";

/* nama database kita */
$database = "hotel_shikifujin";

/* nama user yang terdaftar pada database (default: root) */
$username = "root";

/* password yang terdaftar pada database (default : "") */
$password = "";

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// mengecek koneksi
if (!$conn) {
    die("Maaf koneksi anda gagal : " . mysqli_connect_error());
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
