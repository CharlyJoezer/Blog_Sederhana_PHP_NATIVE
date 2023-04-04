<?php require_once '../Backend/app/Views/Template/head.php' ?>


  <!-- Login Form -->
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Sign In</h2>
          </div>
          <div class="card-body">
            <form action="/auth/login" method="POST">
              <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" />
              </div>
              <div class="d-grid">
                <button type="submit" class="btn text-light main-bg">Login</button>
              </div>
            </form>
            <div class="link-register" style="text-align: center;padding-top:10px;">Belum punya akun ?, <a  href="/register">Register</a></div>
            
          </div>
        </div>
      </div>
    </div>
  </div>


<?php require_once '../Backend/app/Views/Template/footer.php' ?>

    


