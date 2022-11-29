<?php
$file = 'index.php';
if (is_file($file)) {
  $loc = 'view/';
}

if (isset($loc)) {
  include("controller/koneksi.php");
} else {
  include("../controller/koneksi.php");
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $hidden_login = "style='display: none;'";
  if (isset($loc)) {
    $show_profile = "<div class='btn-group dropstart'>
    <button class='btn btn-lg' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
    <i class='bi bi-person-circle'></i>
    </button>
    <ul class='dropdown-menu'>
      <li><a class='dropdown-item' href='view/profile.php?id=$user_id'><i class='bi bi-gear'></i> Settings</a></li>
      <li data-toggle='modal' data-target='#sign_out_modal'><a class='dropdown-item'  href=' model/sign_out.php'><i class='bi bi-box-arrow-in-left' ></i> Sign Out</a></li>
    </ul>
  </div>";
  } else {
    $show_profile = "<div class='btn-group dropstart'>
<button class='btn btn-lg' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
<i class='bi bi-person-circle'></i>
</button>
<ul class='dropdown-menu'>
  <li><a class='dropdown-item' href='../view/profile.php?id=$user_id'><i class='bi bi-gear'></i> Settings</a></li>
  <li data-toggle='modal' data-target='#sign_out_modal'><a class='dropdown-item'  href=' ../model/sign_out.php'><i class='bi bi-box-arrow-in-left' ></i> Sign Out</a></li>
</ul>
</div>";
  }
}


?>
<nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font " href="index.php">Shikifujin Hotel</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href=" <?php if (isset($loc)) {
                                                                        echo 'index.php';
                                                                      } else {
                                                                        echo '../index.php';
                                                                      }; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href=" <?php if (isset($loc)) {
                                            echo 'view/rooms.php';
                                          } else {
                                            echo 'rooms.php';
                                          } ?>">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href=" <?php if (isset($loc)) {
                                            echo 'view/facilities.php';
                                          } else {
                                            echo 'facilities.php';
                                          } ?>">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href=" <?php if (isset($loc)) {
                                            echo 'view/booking.php';
                                          } else {
                                            echo 'booking.php';
                                          } ?>">Reservation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href=" <?php if (isset($loc)) {
                                            echo 'view/blog.php';
                                          } else {
                                            echo 'blog.php';
                                          } ?>">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href=" <?php if (isset($loc)) {
                                            echo 'view/contact.php';
                                          } else {
                                            echo 'contact.php';
                                          } ?>">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=" <?php if (isset($loc)) {
                                        echo 'view/about.php';
                                      } else {
                                        echo 'about.php';
                                      } ?>">About</a>
        </li>
      </ul>
      <div class="d-flex">
        <?php
        if (isset($show_profile)) {
          echo $show_profile;
        }
        ?>
        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" <?php
                                                                                                                                        if (isset($hidden_login)) {
                                                                                                                                          echo $hidden_login;
                                                                                                                                        } ?>>
          Login
        </button>
        <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registrasiModal" <?php
                                                                                                                                if (isset($hidden_login)) {
                                                                                                                                  echo $hidden_login;
                                                                                                                                } ?>>
          Register
        </button>
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action=" <?php if (isset($loc)) {
                                      echo 'model/login.php';
                                    } else {
                                      echo '../model/login.php';
                                    } ?>">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-3"></i>User Login
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control shadow-none">
          </div>
          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control shadow-none">
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <input type="submit" name="submit" class="btn btn-dark shadow-none" value="LOGIN">
            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registrasiModal" <?php
                                              if (isset($hidden_login)) {
                                                echo $hidden_login;
                                              } ?> data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php if (isset($loc)) {
                      echo 'model/register.php';
                    } else {
                      echo '../model/register.php';
                    } ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-3"></i>
            User Registration
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
            Note: Your details must match with your ID (Aadhaar card, passport, driving license, etc)
            that will be required during check-in.
          </span>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="user_email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="number" name="phone" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Date of birth</label>
                <input type="date" name="tanggal_lahir" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 p-0 mb-3">
                <label class="form-label">Address</label>
                <textarea name="alamat" class="form-control shadow-none" rows="1" required></textarea>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pass" class="form-control shadow-none" required>
                <small id="passwordHelpBlock" class="form-text text-muted">
                  Your password must be 8-20 charcters long, contains letter and number, special characters,
                  and must not contain spaces and emoji
                </small>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="repeat_pass" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 p-0 mb-3">
                <label class="form-label">Picture</label>
                <input type="file" name="foto_profile" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="text-center my-1">
            <input type="submit" name="submit" class="btn btn-dark shadow-none" value="REGISTER">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>