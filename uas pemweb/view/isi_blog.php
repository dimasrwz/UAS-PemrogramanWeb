<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <title>Shikifujin Hotel - BLOG</title>
    <?php require('../model/links.php') ?>
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

    ?>

    <?php
    require('header.php');
    include_once('../controller/koneksi.php');

    $judul_artikel = $_GET['judul'];
    $blog_query = mysqli_query($conn, "SELECT * FROM blog WHERE judul = '$judul_artikel' ");
    ?>
    <div class="container">
        <div class="bg-white shadow none p-4">
            <div class="col-md-12">
                <?php

                while ($blog_item = mysqli_fetch_array($blog_query)) {
                ?>
                    <h2 class="py-2 text-center"><?= $blog_item['judul'] ?></h2>
                    <br />
                    <div class="mt-0 mb-5">
                        <?php
                        $thumbnail_blog = $blog_item['thumbnail_artikel']
                        ?>
                        <img <?php echo "src = '../blog_thumbnail/" . $thumbnail_blog . "'";  ?> style="height: 350px;" class="img-fluid rounded mx-auto d-block">
                    </div>
                    <p>
                        <?= $blog_item['isi_artikel']; ?>
                    </p>
                <?php
                }
                ?>
            </div>
        </div>

        <br />
        <h3>Related Posts</h3><br />
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
            $query_post = mysqli_query($conn, "SELECT * FROM blog WHERE status = 'ACTIVE' AND judul != '$judul_artikel' ORDER BY date_post DESC LIMIT 3");
            while ($item = mysqli_fetch_array($query_post)) {
            ?>

                <div class="col">
                    <div class="card h-100">
                        <?php
                        $thumbnail_blog = $item['thumbnail_artikel']
                        ?>
                        <img <?php echo "src = '../blog_thumbnail/" . $thumbnail_blog . "'";  ?> style="height: 200px;" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['judul'] ?></h5>
                            <?php $isi_artikel = $item['isi_artikel'];
                            $isi_artikel = substr($isi_artikel, 0, 100)
                            ?>
                            <p class="card-text" </p><?= $isi_artikel . '...'  ?>
                                <br>
                                <hr>
                                <a href="isi_blog.php?judul=<?= $item['judul'] ?>" class=" text-reset">
                                    Read More
                                    <img width="13" src="https://cdn0.astonhotelsinternational.com/Images/v1/BrandPages/Icon/asst-icn-arrow-right.svg">
                                </a>
                        </div>
                        <div class="card-footer">
                            <?php
                            $tanggal_upload = date("d-m-Y", strtotime($item['date_post']))
                            ?>
                            <small class="text-muted"><?= tanggal_indo($tanggal_upload, true)  ?></small>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>

    <br />

    <?php
    require('footer.php');
    ?>

</body>

</html>