<?php

include_once('../controller/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message_gagal'] = "<div class='alert alert-danger' role='alert'>
    Silahkan login terlebih dahulu </div>";
    header("Location: ../view/contact.php");
} else {
    if (isset($_POST['submit_message'])) {
        $id_user = $_SESSION['user_id'];
        $subjek = $_POST['subjek'];
        $pesan = $_POST['pesan'];

        $message_query = "INSERT INTO user_message (user_id, subject, message ) VALUES ('$id_user', '$subjek', '$pesan')";

        if (mysqli_query($conn, $message_query)) {
            $_SESSION['message_sukses'] = "<div class='alert alert-success' role='alert'>
            pesan berhasil terkirim </div>";
            header("Location: ../view/contact.php");
        } else {
            $_SESSION['message_gagal'] = "<div class='alert alert-danger' role='alert'>
       pesan tidak terkirim </div>";
            header("Location: ../view/contact.php");
        }
    }
}
