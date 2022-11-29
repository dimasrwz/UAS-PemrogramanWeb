<?php

include("../controller/koneksi.php");

if(isset($_SESSION['user_id'])){
    session_destroy();
    header("Location: ../index.php");
}
