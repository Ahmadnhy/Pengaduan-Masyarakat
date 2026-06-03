<?php

$title = 'Login | Petugas';

require '../../src/app.php';

require '../../layouts/header.php';


// logic backend


if (isset($_POST['submit'])) {


  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");

  if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);
    if ($_SESSION['level'] = $row['level'] == 'admin') {
      header("location:../admin/dashboard.php");
    } else if ($_SESSION['level'] = $row['level'] == 'petugas') {
      header("location:dashboard.php");
    }
  } else {
    $error = true;
  }
}

?>


<div class="d-flex justify-content-center py-5 mt-5">
  <div class="card shadow mt-3 glass-card animate-fade-in-up" data-aos="fade-down" style="max-width: 480px; width: 100%;">
    <div class="card-body p-5">
      <div class="mb-4">
        <h3 class="font-weight-bold text-dark text-uppercase">Portal Petugas</h3>
        <p class="text-secondary small">Masuk untuk mengelola pengaduan, verifikasi data, dan memberikan tanggapan.</p>
      </div>

      <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 0.75rem;" role="alert">
          <span class="small font-weight-bold text-danger">Maaf, username atau password Anda salah.</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      
      <form action="" method="post" class="mt-4">
        <div class="form-group mb-3">
          <label for="username" class="font-weight-bold text-secondary small">Username</label>
          <input type="text" class="form-control shadow-sm" id="username" placeholder="Masukkan Username" name="username" required>
        </div>
        <div class="form-group mb-4">
          <label for="password" class="font-weight-bold text-secondary small">Password</label>
          <input type="password" class="form-control shadow-sm" id="password" placeholder="Masukkan Password" name="password" required>
        </div>
        
        <div class="text-center">
          <button type="submit" name="submit" class="btn btn-primary shadow-lg py-2 px-4 mt-2">Masuk sebagai Petugas</button>
        </div>
        
        <div class="text-center mt-4">
          <a href="../user/login.php" class="text-primary font-weight-bold small"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Login Warga</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>