<?php
include_once('../controller/koneksi.php');
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM user_data WHERE user_id=$id");

while ($item = mysqli_fetch_array($result)) {
    $alamat = $item['alamat'];
    $tanggal_lahir = $item['tanggal_lahir'];
}

if (isset($_POST['update'])) {
    if ($_POST['change_date'] == '') {
        $_POST['change_date'] = $tanggal_lahir;
    }
    if ($_POST['change_address'] == '') {
        $_POST['change_address'] = $alamat;
    }

    $nama = $_POST['change_name'];
    $alamat = $_POST['change_address'];
    $phone = $_POST['change_phone'];
    $tanggal_lahir = $_POST['change_date'];

    $result = mysqli_query($conn, "UPDATE user_data SET nama = '$nama' , alamat ='$alamat', phone_number ='$phone' ,tanggal_lahir ='$tanggal_lahir' WHERE user_id=$id");

    if ($result) {
        $_SESSION['sukses_ganti_data_user'] = "<div class='alert alert-success' role='alert'>
        Berhasil mengganti data </div>";
        header("Location: ../view/profile.php?id=$id");
    }
}

if (isset($_POST['change_password'])) {
    if (isset($_POST["new_password"])) {
        $password = $_POST["new_password"];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
    }

    if (isset($_POST["repeat_password"])) {
        $confirm = $_POST["repeat_password"];
    }

    if (isset($password)) {
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || $confirm != $password) {
            $_SESSION['gagal_ganti_password'] = "<div class='alert alert-danger' role='alert'>
            Kata sandi harus setidaknya 8 karakter dan harus mencakup setidaknya satu huruf besar, satu angka, dan satu karakter khusus. </div>";
            header("Location: ../view/profile.php?id=$id");
        } else {
            $_SESSION['sukses_ganti_password'] = "<div class='alert alert-success' role='alert'>
            Kata sandi berhasil diganti </div>";
            $pass = md5($password);
            $ganti_pass = mysqli_query($conn, "UPDATE user_data SET password = '$pass' WHERE user_id=$id ");
            header("Location: ../view/profile.php?id=$id");
        }
    }
}

if (isset($_POST['upload_image'])) {
    if (isset($_FILES['change_photo_profile'])) {
        $my_image_name = $_FILES['change_photo_profile']['name'];
        $tmp_name = $_FILES['change_photo_profile']['tmp_name'];
        $error = $_FILES['change_photo_profile']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($my_image_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "png", "jpeg");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../profile/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $ganti_profile = mysqli_query($conn, "UPDATE user_data SET photo_profile = '$new_img_name' WHERE user_id=$id  ");

                if ($ganti_profile) {
                    $_SESSION['sukses_ganti_photo'] = "<div class='alert alert-success' role='alert'>
            photo profile berhasil diganti </div>";
                    header("Location: ../view/profile.php?id=$id");
                }
            } else {
                $_SESSION['gagal_ganti_photo'] = "<div class='alert alert-danger' role='alert'>
                tipe file foto profil tidak valid (png,jpg,jpeg)</div>";
                header("Location: ../view/profile.php?id=$id");
            }
        }
    }
}
