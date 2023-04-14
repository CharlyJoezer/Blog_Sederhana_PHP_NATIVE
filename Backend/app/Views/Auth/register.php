<?php require_once '../Backend/app/Views/Template/head.php' ?>

  <!-- Login Form -->
  <div class="container">
    <div class="row justify-content-center bg-light">
      <div class="card-title text-center border-bottom">
        <div class="header-daftar">
          <img src="/asset/logo.png" alt="">ostingan
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-title text-center border-bottom text-header-register">
            Daftar
          </div>
          <div class="card-body">
            <form action="/auth/register" method="POST">
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" required name="username" class="form-control" id="username" autocomplete="off"/>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" required name="password" class="form-control" id="password" autocomplete="off"/>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary text-dark main-bg">Daftar</button>
              </div>
            </form>
            <div class="link-login" style="text-align: center;padding-top:10px;">Sudah punya akun ?, <a  href="/login">Masuk</a></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once '../Backend/app/Views/Template/footer.php' ?>