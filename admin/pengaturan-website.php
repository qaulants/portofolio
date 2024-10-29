<?php
session_start();

include 'koneksi.php';
$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);
//jika button simpan ditekan
if (isset($_POST['simpan'])) {
  $website_email = $_POST['website_email'];
  $website_phone = $_POST['website_phone'];
  $website_address = $_POST['website_address'];
  $ig_link = $_POST['ig_link'];
  $fb_link = $_POST['fb_link'];
  $linkedin_link = $_POST['linkedin_link'];
  $id = $_POST['id'];

  // mencari data di dalam tabel pengaturan, jika ada data akan di update,
  // jika tidak ada data akan di insert
  if (mysqli_num_rows($queryPengaturan) > 0) {
    if (!empty($_FILES['foto']['name'])) {
      $nama_foto = $_FILES['foto']['name'];
      $ukuran_foto = $_FILES['foto']['size'];

      // png, jpg, jpeg
      $ext = array('png', 'jpg', 'jpeg', 'jfif');
      $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

      //JIKA EXTENSI FOTO TIDAK ADA DI DAFTAR ARRAY EXT
      if (!in_array($extFoto, $ext)) {
        echo "Maaf, hanya bisa upload file dengan ekstensi png, jpg, jpeg";
        die;
      } else {
        //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
        // unlink: mendelete file
        unlink('upload/logo/' . $rowPengaturan['logo']);
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/logo/' . $nama_foto);

        $update = mysqli_query($koneksi, "UPDATE general_setting SET website_email ='$website_email', website_phone='$website_phone', website_address='$website_address', ig_link='$ig_link', fb_link = '$fb_link', linkedin_link='$linkedin_link', logo='$nama_foto'  WHERE id='$id'");
      }
    } else {
      $update = mysqli_query($koneksi, "UPDATE general_setting SET website_email ='$website_email', website_phone='$website_phone', website_address='$website_address', ig_link='$ig_link', fb_link = '$fb_link', linkedin_link='$linkedin_link' WHERE id = '$id'");
    }
  } else {
    if (!empty($_FILES['foto']['name'])) {
      $nama_foto = $_FILES['foto']['name'];
      $ukuran_foto = $_FILES['foto']['size'];

      // png, jpg, jpeg
      $ext = array('png', 'jpg', 'jpeg', 'jfif');
      $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

      //JIKA EXTENSI FOTO TIDAK ADA DI DAFTAR ARRAY EXT
      if (!in_array($extFoto, $ext)) {
        echo "Maaf, hanya bisa upload file dengan ekstensi png, jpg, jpeg";
        die;
      } else {
        //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/logo/' . $nama_foto);

        $insert = mysqli_query($koneksi, "INSERT INTO general_setting (website_email, website_phone, website_address, ig_link, fb_link, linkedin_link, logo) VALUES ('$website_email', '$website_phone', '$website_address', '$ig_link', '$fb_link', '$linkedin_link', '$nama_foto')");
      }
    } else {
      $insert = mysqli_query($koneksi, "INSERT INTO general_setting (website_email, website_phone, website_address, ig_link, fb_link, linkedin_link,) VALUES ('$website_email', '$website_phone', '$website_address', '$ig_link', '$fb_link', '$linkedin_link')");
    }
  }

  header("location:pengaturan-website.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaturan Website</title>

  <?php include 'inc/head.php' ?>
</head>

<body>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include 'inc/sidebar.php'; ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include 'inc/navbar.php' ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
              <div class="col-lg-12 mb-4">

                <!-- Approach -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Pengaturan Website</h4>
                  </div>
                  <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" class="form-control" value="<?php echo isset($rowPengaturan['id']) ? $rowPengaturan['id'] : '' ?>">
                      <div class="mb-3 row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="website_email" class="form-control" placeholder="Masukkan Email Anda" required value="<?php echo isset($rowPengaturan['website_email']) ? $rowPengaturan['website_email'] : '' ?>">
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Nomor Telepon</label>
                            <input type="number" name="website_phone" class="form-control" placeholder="Masukkan Nomor Telepon" required value="<?php echo isset($rowPengaturan['website_phone']) ? $rowPengaturan['website_phone'] : '' ?>">
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <input type="text" name="website_address" class="form-control" placeholder="Masukkan Alamat Anda" required value="<?php echo isset($rowPengaturan['website_address']) ? $rowPengaturan['website_address'] : '' ?>">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label for="" class="form-label">Link Instagram</label>
                            <input type="url" name="ig_link" class="form-control" placeholder="Masukkan link instagram" value="<?php echo isset($rowPengaturan['ig_link']) ? $rowPengaturan['ig_link'] : '' ?>">
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Link Facebook</label>
                            <input type="url" name="fb_link" class="form-control" placeholder="Masukkan link facebook" value="<?php echo isset($rowPengaturan['fb_link']) ? $rowPengaturan['fb_link'] : '' ?>">
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Link Linkedin</label>
                            <input type="url" name="linkedin_link" class="form-control" placeholder="Masukkan link linkedin" value="<?php echo isset($rowPengaturan['linkedin_link']) ? $rowPengaturan['linkedin_link'] : '' ?>">
                          </div>
                        </div>

                      </div>

                      <div class="mb-3 row">
                        <div class="col-sm-12">
                          <label for="" class="form-label">Logo</label>
                          <input type="file" name="foto">
                          <img width="100" src="upload/logo/<?php echo isset($rowPengaturan['logo']) ? $rowPengaturan['logo'] : '' ?>" alt="">
                        </div>
                      </div>

                      <div class="mb-3">
                        <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                          Simpan
                        </button>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'inc/footer.php' ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- js -->
    <?php include 'inc/js.php' ?>
  </body>
</body>

</html>