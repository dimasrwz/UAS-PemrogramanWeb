<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <title>Shikifujin Hotel - BLOG</title>
    <?php require('../model/links.php') ?>
    <style>
        .card-img-top {
            width: 100%;
            height: 18vw;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    // FUNGSI
    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split       = explode('-', $tanggal);
        $tgl_indo = $split[0] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[2];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

    function lama_baca_teks($teks)
    {
        $jumlah_kata = str_word_count($teks);
        $kata_per_menit = 135;
        $lama_baca = $jumlah_kata / $kata_per_menit;
        $lama_baca = ceil($lama_baca);
        echo $lama_baca . " minute read";
    }

    ?>

    <?php
    require('header.php');
    include_once('../controller/koneksi.php');

    $query_blog = mysqli_query($conn, "SELECT * FROM blog WHERE status = 'ACTIVE' ORDER BY date_post DESC LIMIT 3");


    ?>

    <?php
    $batas = 3;
    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

    $previous = $halaman - 1;
    $next = $halaman + 1;

    $query_blog = mysqli_query($conn, "SELECT * FROM blog ORDER BY date_post DESC");
    $jumlah_data = mysqli_num_rows($query_blog);
    $total_halaman = ceil($jumlah_data / $batas);

    $data_blog = mysqli_query($conn, "SELECT * FROM blog ORDER BY date_post DESC LIMIT $halaman_awal, $batas");
    $nomor = $halaman_awal + 1;

    ?>

    <div class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Shikifujin Blog</h1>
                <p class="lead my-3">Silahkan berkunjung ke blog kami</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
            </div>
        </div>

        <?php

        while ($blog_item = mysqli_fetch_array($data_blog)) {
        ?>

            <div class="card mb-3" style="max-width: auto;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <?php
                        $thumbnail_blog = $blog_item['thumbnail_artikel']
                        ?>
                        <img <?php echo "src = '../blog_thumbnail/" . $thumbnail_blog . "'";  ?> class="card-img-top img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $blog_item['judul'] ?></h5>
                            <?php $isi_artikel = $blog_item['isi_artikel'];
                            $isi_artikel = substr($isi_artikel, 0, 150)
                            ?>
                            <p class="card-text"><?= $isi_artikel . '...'  ?></p>
                            <p class="card-text"><small class="text-muted"><?= lama_baca_teks($blog_item['isi_artikel']); ?></small></p>
                            <a href="isi_blog.php?judul=<?= $blog_item['judul'] ?>" class="text-reset">
                                Read More..
                                <img width="13" src="https://cdn0.astonhotelsinternational.com/Images/v1/BrandPages/Icon/asst-icn-arrow-right.svg">
                            </a>
                            <?php
                            $tanggal_upload = date("d-m-Y", strtotime($blog_item['date_post']))
                            ?>
                            <p class="card-text"><small class="text-muted"><?= tanggal_indo($tanggal_upload, true)  ?></small></p>

                        </div>
                    </div>
                </div>
            </div>



        <?php

        }
        ?>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='?halaman=$previous'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                echo "href='?halaman=$next'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php

    require('footer.php');
    ?>


</body>

</html>