<?php
include 'admin/koneksi.php';
// DATA instruktur
$queryProject = mysqli_query($koneksi, "SELECT * FROM project ORDER BY id DESC LIMIT 6");

$querUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC LIMIT 1");
$rowUser = mysqli_fetch_assoc($querUser);

$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);
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
      <img src="admin/upload/<?php echo $rowUser['foto_user'] ?>" alt="">
    </div>
  </section>

  <!-- about -->
  <section class="about" id="about">
    <div class="about-img">
      <img src="img/4.jpg" alt="">
    </div>

    <div class="about-content">
      <h2 class="heading">About Me</h2>
      <h3>Web Developer</h3>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores aut, harum, beatae fugiat consectetur debitis quisquam excepturi inventore totam eum molestias ipsum nobis similique obcaecati provident, tempora pariatur animi rerum?</p>
      <a href="#" class="btn">Read more</a>
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

    <form action="#">
      <div class="input-box">
        <input type="text" placeholder="Name">
        <input type="email" placeholder="Email">
      </div>
      <div class="input-box">
        <input type="number" placeholder="Your number phone">
        <input type="text" placeholder="Email Subject">
      </div>
      <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
      <button type="submit" value="Send Message" class="btn">Send Message</button>
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