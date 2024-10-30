<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];

  if (!empty($_FILES['img_icon']['name'])) {
    $nama_foto = $_FILES['img_icon']['name'];
    $ukuran_foto = $_FILES['img_icon']['size'];

    $ext = array('png', 'jpg', 'jpeg', 'jfif', 'svg');
    $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

    //jika extensi file tida ada di daftar array ext
    if (!in_array($extFoto, $ext)) {
      echo "Format file yang diperbolehkan hanya.png,.jpg,.jpeg,.jfif!,.svg!";
      die;
    } else {
      //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
      move_uploaded_file($_FILES['img_icon']['tmp_name'], 'upload/skill/' . $nama_foto);

      $insert = mysqli_query($koneksi, "INSERT INTO skill (nama, gambar_icon) VALUES ('$nama', '$nama_foto')");
    }
  } else {
    $insert = mysqli_query($koneksi, "INSERT INTO skill (nama) VALUES ('$nama')");
  }
  header("location:skill.php?tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($koneksi, "SELECT * FROM skill WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
  $nama = $_POST['nama'];

  //jika user ingin memasukkan gambar
  if (!empty($_FILES['img_icon']['name'])) {
    $nama_foto = $_FILES['img_icon']['name'];
    $ukuran_foto = $_FILES['img_icon']['size'];

    // png, jpg, jpeg
    $ext = array('png', 'jpg', 'jpeg', 'jfif', 'svg');
    $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

    if (!in_array($extFoto, $ext)) {
      echo "ekstensi gambar tidak ditemukan";
      die;
    } else {
      unlink('upload/skill/' . $rowEdit['img_icon']);
      move_uploaded_file($_FILES['img_icon']['tmp_name'], 'upload/skill/' . $nama_foto);

      // coding update 
      $update = mysqli_query($koneksi, "UPDATE skill SET nama='$nama', gambar_icon='$nama_foto' WHERE id = '$id'");
    }
  } else { //kalau user tidak ingin memasukkan gambar
    $update = mysqli_query($koneksi, "UPDATE skill SET nama='$nama' WHERE id = '$id'");
  }

  header("location:skill.php?edit=berhasil");
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
                  <h4 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Project</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama skill" required value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>">
                      </div>
                    </div>

                    <div class="mb-3 row">
                      <div class="col-sm-12">
                        <label for="" class="form-label">Gambar Icon</label>
                        <input type="file" name="img_icon">
                        <img width="100" src="upload/skill/<?php echo isset($_GET['edit']) ? $rowEdit['gambar_icon'] : '' ?>" alt="">
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