<?php
session_start();
include 'koneksi.php';

$id = isset($_GET['detail']) ? $_GET['detail'] : "";
$queryDetail = mysqli_query($koneksi, "SELECT * FROM pesan WHERE id='$id'");
$rowDetail = mysqli_fetch_assoc($queryDetail);

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
                  <h4 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET['detail']) ? 'Detail' : '' ?> Pesan</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Nama</label>
                        <input readonly type="text" class="form-control" name="nama" value="<?php echo isset($_GET['detail']) ? $rowDetail['nama'] : '' ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" readonly value="<?php echo isset($_GET['detail']) ? $rowDetail['email'] : '' ?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control" readonly value="<?php echo isset($_GET['detail']) ? $rowDetail['no_hp'] : '' ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" readonly value="<?php echo isset($_GET['detail']) ? $rowDetail['subjek'] : '' ?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Message</label>
                        <textarea type="text" name="isi_pesan" class="form-control" readonly><?php echo isset($_GET['detail']) ? $rowDetail['isi_pesan'] : '' ?></textarea>
                      </div>
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