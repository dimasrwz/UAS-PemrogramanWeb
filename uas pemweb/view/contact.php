<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <title>Shikifujin Hotel - CONTACT</title>
    <?php require('../model/links.php') ?>
</head>

<body class="bg-light">

    <?php
    require('header.php');
    include_once('../controller/koneksi.php');
    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Aut omnis quidem consectetur, eaque rem <br> dolores doloremque neque est sunt?
            Explicabo sit eius provident pariatur ratione. Maxime quasi reiciendis iure. Aspernatur!
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">

                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.2083897634843!2d110.82758337042642!3d-7.552241648911811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a170148d67c6f%3A0x4e76d794dd0874ef!2sMasjid%20Raya%20Sheikh%20Zayed%20Surakarta!5e0!3m2!1sen!2sid!4v1668589203723!5m2!1sen!2sid" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    <h5>Address</h5>
                    <a href="https://goo.gl/maps/CwKQRMWsEztY1Mjq6" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i>Masjid Raya Sheikh Zayed, Surakarta
                    </a>

                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel: +628495773823" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+628495773823
                    </a>
                    <br>
                    <a href="tel: +628495773823" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+628495773823
                    </a>

                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: ask.dimasrw11@gmail.com" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i>dimasrw11@gmail.com
                    </a>

                    <h5 class="mt-4">Follow Us</h5>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-twitter me-1"></i>
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-5">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4 mb-2">
                    <form action="../model/send_message.php" method="post">
                        <h5>Send a Message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="nama" type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subjek" type="text" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="pesan" class="form-control shadow-none" rows="5" style="resize: none;" required></textarea>
                        </div>
                        <input name="submit_message" role="button" type="submit" class="btn text-white custom-bg mt-3" value="SEND">
                    </form>

                </div>
                <?php

                if (isset($_SESSION['message_sukses'])) {
                    echo $_SESSION['message_sukses'];
                } elseif (isset($_SESSION['message_gagal'])) {
                    echo $_SESSION['message_gagal'];
                }


                if ($pageWasRefreshed) {
                    if (isset($_SESSION['message_sukses'])) {
                        unset($_SESSION['message_sukses']);
                    } elseif (isset($_SESSION['message_gagal'])) {
                        unset($_SESSION['message_gagal']);
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