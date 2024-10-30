<?php
include 'admin/koneksi.php';
// DATA instruktur
$queryProject = mysqli_query($koneksi, "SELECT * FROM project ORDER BY id DESC LIMIT 6");

$querUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC LIMIT 1");
$rowUser = mysqli_fetch_assoc($querUser);

$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);

$queryAbout = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
$rowAbout = mysqli_fetch_assoc($queryAbout);

if (isset($_POST['send'])) {
  $name = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $no_hp = htmlspecialchars($_POST['no_hp']);
  $subject = htmlspecialchars($_POST['subjek']);
  $message = htmlspecialchars($_POST['isi_pesan']);

  $select = mysqli_query($koneksi, "SELECT email FROM pesan WHERE email = '$email'");

  if (mysqli_num_rows($select) > 0) {
      header("location: index.php?status=email-sudahada");
      exit();
  } else {
      $insert = mysqli_query($koneksi, "INSERT INTO pesan (nama, email, no_hp, subjek, isi_pesan) VALUES ('$name', '$email', '$no_hp', '$subject', '$message') ");

      if ($insert) {
          header("Location: index.php?status=success");
          exit();
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- main css -->
  <link rel="stylesheet" href="styles.css">
  <title>Document</title>
</head>

<body>
  <!-- header -->
  <header class="header">
    <a href="" class="logo">Qaulan Tsaqila</a>

    <i class="fa-solid fa-bars" id="menu-icon"></i>

    <nav class="navbar">
      <a href="#home" class="active">Home</a>
      <a href="#about">About</a>
      <a href="#services">My Skils</a>
      <a href="#portofolio">Portofolio</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>

  <!-- home section -->
  <section class="home" id="home">
    <div class="home-content">
      <h3>Hi, My Name is</h3>
      <h1>Qaulan Tsaqila</h1>
      <h3>Am I <span class="multiple-text"></span></h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil unde quibusdam quo.</p>
      <div class="social-media">
        <a href="<?php echo $rowPengaturan['fb_link'] ?>"><i class="fa-brands fa-facebook"></i></a>
        <a href="<?php echo $rowPengaturan['ig_link'] ?>"><i class="fa-brands fa-instagram"></i></a>
        <a href="<?php echo $rowPengaturan['linkedin_link'] ?>"><i class="fa-brands fa-linkedin"></i></a>
      </div>
      <a href="#" class="btn">Download CV</a>
    </div>
    <div class="home-img">
      <img src="" alt="">
    </div>
  </section>
<!--  -->
  <!-- about -->
  <section class="about" id="about">
    <div class="about-img">
      <img src="admin/upload/<?php echo $rowUser['foto_user'] ?>" alt="">
    </div>

    <div class="about-content">
      <h2 class="heading">About <span>Me</span></h2>
      <!-- <h3>Web Developer</h3> -->
          <p class="fst-italic py-3">
            <?php echo $rowAbout['deskripsi_diri'];?>
          </p>
          <ul>
            <li> <strong>Birthday:</strong> <span><?php echo $rowAbout['birthday'];?></span></li> 
            <li> <strong>Email:</strong> <span><?php echo $rowAbout['email'];?></span></li>
            <li> <strong>City:</strong> <span><?php echo $rowAbout['city'];?></span></li>
            <li> <strong>Degree:</strong> <span><?php echo $rowAbout['degree'] ?></span></li>
            <li> <strong>Freelance:</strong> <span>Available</span></li>
          </ul>  
    </div>
  </section>

  <!-- skills -->
  <section class="services" id="services">
    <h2 class="heading">My <span>Skills</span> </h2>

    <div class="services-container">
      <div class="services-box">
        <i class="fa-brands fa-html5"></i>
        <h3>HTML</h3>
      </div>
      <div class="services-box">
        <i class="fa-brands fa-css3-alt"></i>
        <h3>CSS</h3>
      </div>
      <div class="services-box">
        <i class="fa-brands fa-js"></i>
        <h3>JS</h3>
      </div>
      <div class="services-box">
        <i class="fa-brands fa-bootstrap"></i>
        <h3>Bootstrap</h3>
      </div>
      <div class="services-box">
        <i class="fa-brands fa-bootstrap"></i>
        <h3>Bootstrap</h3>
      </div>
      <div class="services-box">
        <i class="fa-brands fa-bootstrap"></i>
        <h3>Bootstrap</h3>
      </div>
    </div>
  </section>

  <!-- portofolio section -->
  <section class="portofolio" id="portofolio">
    <h2 class="heading">Latest <span>Project</span></h2>
    <div class="portofolio-container">
      <?php while ($rowProject = mysqli_fetch_assoc($queryProject)): ?>
        <div class="portofolio-box">
          <img src="admin/upload/project/<?php echo $rowProject['foto_bg'] ?>" alt="">
          <div class="portofolio-layer">
            <h4><?php echo $rowProject['judul'] ?></h4>
            <p><?php echo $rowProject['deskripsi'] ?></p>
            <a href="<?php echo $rowProject['link'] ?>"><i class="fa-solid fa-up-right-from-square"></i></a>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  </section>

  <!-- contact -->
  <section class="contact" id="contact">
    <h2 class="heading">
      Contact <span>Me</span>
    </h2>
    <?php if (isset($_GET['status']) && $_GET['status'] == "success") {
                        echo "<div class='alert alert-primary' role='alert'>Data Berhasil Dikirim</div>";
                    } elseif (isset($_GET['status']) && $_GET['status'] == "email-sudahada") {
                        echo "<div class='alert alert-warning' role='alert'>Email Sudah Ada</div>";
                    }
    ?>
    <form method="POST" action="">
      <div class="input-box">
        <input type="text" placeholder="Name" name="nama" required>
        <input type="email" placeholder="Email" name="email" required>
      </div>
      <div class="input-box">
        <input type="number" placeholder="Your number phone" name="no_hp" required>
        <input type="text" placeholder="Subject" name="subjek" required>
      </div>
      <textarea name="isi_pesan" id="" cols="30" rows="10" placeholder="Your Message" required></textarea>
      <button type="submit" value="Send Message" name="send" class="btn">Send Message</button>
    </form>
  </section>
  <!-- footer -->
  <footer class="footer">
    <div class="footer-text">
      <p>Copyright &copy; 2024 @qaulants | All Right Reserved</p>
    </div>

    <div class="footer-iconTop">
      <a href="#home"><i class="fa-solid fa-angle-up"></i></a>
    </div>
  </footer>

  <!-- scroll reveal js -->
  <script src="https://unpkg.com/scrollreveal"></script>
  <!-- typed js -->
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <!-- main js -->
  <script src="main.js"></script>

</body>

</html>