<?php
session_start();
include 'koneksi.php';
$queryUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");
$rowUser = mysqli_fetch_assoc($queryUser);

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $id = $_POST['id'];
  $password = $_POST['password'];

  if (mysqli_num_rows($queryUser) > 0) {
    if (!empty($_FILES['foto']['name'])) {
      $nama_foto = $_FILES['foto']['name'];
      $ukuran_foto = $_FILES['foto']['size'];

      $ext = array('png', 'jpg', 'jpeg', 'jfif');
      $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

      //JIKA EXTENSI FOTO TIDAK ADA DI DAFTAR ARRAY EXT
      if (!in_array($extFoto, $ext)) {
        echo "Format foto harus PNG, JPG, JPEG, atau JFIF.";
        die;
      } else {
        //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
        // unlink: mendelete file
        @unlink('upload/' . $rowUser['foto_user']);
        // UPLOAD FOTO
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

        $updateUser = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', foto_user='$nama_foto' WHERE id='$id'");
      }
    } else {
      $updateUser = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email' WHERE id='$id'");
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
        echo "Maaf, hanya bisa upload file dengan ekstensi png, jpg, jpeg, atau JFIF.";
        die;
      } else {
        //pindahkan gambar dari tmp folder ke folder yang sudah kita buat 
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

        $insert = mysqli_query($koneksi, "INSERT INTO user (nama, email, foto_user) VALUES ('$nama', '$email', '$nama_foto')");
      }
    } else {
      $insert = mysqli_query($koneksi, "INSERT INTO user (nama, email) VALUES ('$nama', '$email')");
    }
  }

  header("location:user.php");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : "";
$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  //jika pass diisi sama user
  if ($_POST['password']) {
    $password = $_POST['password'];
  } else {
    $password = $rowEdit['password'];
  }

  $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id = '$id'");
  header("location:user.php?edit=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data User</title>

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
                  <h4 class="m-0 font-weight-bold text-primary">Data Profile</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" value="<?php echo isset($rowUser['id']) ? $rowUser['id'] : '' ?>">
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" required value="<?php echo isset($rowUser['nama']) ? $rowUser['nama'] : '' ?>">
                      </div>
                      <div class=" col-sm-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required value="<?php echo isset($rowUser['email']) ? $rowUser['email'] : '' ?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-12">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" id="" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-sm-12">
                        <label for="" class="form-label">Foto</label>
                        <input type="file" name="foto">
                        <img width="100" src="upload/<?php echo isset($rowUser['foto_user']) ? $rowUser['foto_user'] : '' ?>" alt="">
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