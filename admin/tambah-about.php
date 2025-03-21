<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $deskripsi_diri = $_POST['deskripsi_diri'];
  $birthday = $_POST['birthday'];
  $email = $_POST['email'];
  $city = $_POST['city'];
  $degree = $_POST['degree'];

  $insert = mysqli_query($koneksi, "INSERT INTO about (deskripsi_diri, birthday, email, city, degree) VALUES ('$deskripsi_diri', '$birthday', '$email', '$city', '$degree')");

  header("location:about.php?tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($koneksi, "SELECT * FROM about WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $deskripsi_diri = $_POST['deskripsi_diri'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $degree = $_POST['degree'];
    
    $update = mysqli_query($koneksi, "UPDATE about SET deskripsi_diri='$deskripsi_diri', birthday='$birthday', email='$email', city='$city', degree='$degree' WHERE id = '$id'");

  header("location:about.php?edit=berhasil");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <?php include 'inc/head.php' ?>
</head>

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
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> About</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Birthday</label>
                        <input required type="date" class="form-control" name="birthday" value="<?php echo isset($_GET['edit']) ? $rowEdit['birthday'] : '' ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                       <div class="col-sm-6">
                        <label for="" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="Masukkan kota Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['city'] : '' ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="" class="form-label">Degree</label>
                        <input type="text" name="degree" class="form-control" placeholder="Masukkan kota Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['degree'] : '' ?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea type="text" name="deskripsi_diri" class="form-control" placeholder="Masukkan Deskripsi about me" required><?php echo isset($_GET['edit']) ? $rowEdit['deskripsi_diri'] : '' ?></textarea>
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

</html>