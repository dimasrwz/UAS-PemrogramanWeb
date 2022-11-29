<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <?php require('../model/links.php');
    include_once('../controller/koneksi.php');
    $id = $_GET['id']; ?>
    <?php
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
    }
    ?>

</head>

<body class="bg-light">

    <?php
    require('header.php');
    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">PROFILE</h2>
                <div style="font-size: 14px;">
                    <a href="../index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
                </div>
            </div>

            <?php

            $result = mysqli_query($conn, "SELECT * FROM user_data WHERE user_id=$id");

            while ($item = mysqli_fetch_array($result)) {
                $nama = $item['nama'];
                $phone = $item['phone_number'];
                $photo = $item['photo_profile'];
                $alamat = $item['alamat'];
            }
            ?>

            <div class="col-12 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form method="post" action="../model/change_profile.php?id=<?= $id ?>">
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="change_name" class="form-control shadow-none" value="<?= $nama ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="change_phone" class="form-control shadow-none" value="<?= $phone ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of birth</label>
                                <input type="date" name="change_date" class="form-control shadow-none">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" name="change_address" rows="1" placeholder="<?= $alamat ?>"></textarea>
                            </div>
                        </div>
                        <input name="update" role="button" type="submit" class="btn text-white custom-bg shadow-none" value="Save Changes">
                    </form>
                </div>
                <?php

                if (isset($_SESSION['sukses_ganti_data_user'])) {
                    echo $_SESSION['sukses_ganti_data_user'];
                }

                if ($pageWasRefreshed) {
                    if (isset($_SESSION['sukses_ganti_data_user'])) {
                        unset($_SESSION['sukses_ganti_data_user']);
                    }
                }
                ?>
            </div>

            <div class="col-md-4 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form method="post" action="../model/change_profile.php?id=<?= $id ?>" enctype="multipart/form-data">
                        <h5 class="mb-3 fw-bold">Picture</h5>
                        <img <?php echo "src = '../profile/" . $photo . "'";  ?> class="rounded-circle img-fluid mb-3">

                        <label class="form-label">New Picture</label>
                        <input name="change_photo_profile" type="file" class="mb-4 form-control shadow-none" required>

                        <input name="upload_image" role="button" type="submit" class="btn text-white custom-bg shadow-none" value="Save Changes">
                    </form>
                </div>
                <?php
                if (isset($_SESSION['gagal_ganti_photo'])) {
                    echo $_SESSION['gagal_ganti_photo'];
                    if (isset($_SESSION['sukses_ganti_photo'])) {
                        unset($_SESSION['sukses_ganti_photo']);
                    }
                } elseif (isset($_SESSION['sukses_ganti_photo'])) {
                    echo $_SESSION['sukses_ganti_photo'];
                }

                if ($pageWasRefreshed) {
                    if (isset($_SESSION['gagal_ganti_photo'])) {
                        unset($_SESSION['gagal_ganti_photo']);
                    } elseif (isset($_SESSION['sukses_ganti_photo'])) {
                        unset($_SESSION['sukses_ganti_photo']);
                    }
                }
                ?>
            </div>


            <div class="col-md-8 mb-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form method="post" action="../model/change_profile.php?id=<?= $id ?>">
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password</label>
                                <input name="new_password" type="password" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm Password</label>
                                <input name="repeat_password" type="password" class="form-control shadow-none" required>
                            </div>
                        </div>
                        <input name='change_password' type="submit" class="btn text-white custom-bg shadow-none" value="Save Changes">
                    </form>
                </div>
                <?php
                if (isset($_SESSION['gagal_ganti_password'])) {
                    echo $_SESSION['gagal_ganti_password'];
                    if (isset($_SESSION['sukses_ganti_password'])) {
                        unset($_SESSION['sukses_ganti_password']);
                    }
                } elseif (isset($_SESSION['sukses_ganti_password'])) {
                    echo $_SESSION['sukses_ganti_password'];
                }

                if ($pageWasRefreshed) {
                    if (isset($_SESSION['gagal_ganti_password'])) {
                        unset($_SESSION['gagal_ganti_password']);
                    } elseif (isset($_SESSION['sukses_ganti_password'])) {
                        unset($_SESSION['sukses_ganti_password']);
                    }
                }
                ?>
            </div>

        </div>
    </div>

    <?php
    require('footer.php');
    ?>

</body>

</html>