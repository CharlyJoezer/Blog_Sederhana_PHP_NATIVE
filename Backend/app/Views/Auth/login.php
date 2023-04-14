<?php require_once '../Backend/app/Views/Template/head.php' ?>


  <!-- Login Form -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="card-title text-center border-bottom">
        <div class="header-login">
          <img src="/asset/logo.png" alt="">ostingan
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-lg-12">
        <div class="card shadow">
        <div class="card-title text-center border-bottom text-header-login">
            Selamat datang
          </div>
          <div class="card-body">
            <form action="/auth/login" method="POST">
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" required name="username" class="form-control" id="username" autocomplete="off" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" required name="password" class="form-control" id="password" autocomplete="off" />
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary text-dark main-bg">Masuk <i class="fa-solid fa-arrow-right-to-bracket"></i></button>
              </div>
            </form>
            <div class="link-register" style="text-align: center;padding-top:10px;font-size:12px;">Belum punya akun ?, <a  href="/register">Daftar</a></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>


<?php require_once '../Backend/app/Views/Template/footer.php' ?>

    


