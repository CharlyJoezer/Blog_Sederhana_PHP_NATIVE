  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Welcome</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <?php if(!isset($_SESSION['login'])):?>
          <li class="nav-item">
            <a class="nav-link"  href="login">Sign In</a>
          </li>
        <?php endif;?>
        <?php if(isset($auth)):?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="text-transform:capitalize;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $auth['username'] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/profil">Profil Saya</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat Post</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
          </li>
        <?php endif;?>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<!-- POPUP CREATE MEME -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Posting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="/create/postingan" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3 file-input-container">
            <label for="file-input" class="file-input-label" id="file-input-label">Pilih Gambar</label>
            <input type="file" id="file-input" name="image" class="file-input" name="file">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Tulis Caption : </label>
            <textarea class="form-control" name="caption" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Posting</button>
        </div>
      </form>

    </div>
  </div>
</div>



<script>
  
  const fileInput = document.getElementById('file-input');
  const previewContainer = document.getElementById('file-input-label');

  fileInput.addEventListener('change', function() {
    previewContainer.html = ''
    const file = this.files[0];
    
    if (file) {
      const reader = new FileReader();
      
      reader.addEventListener('load', function() {
        previewContainer.style.backgroundImage = `url('${this.result}')`;
      });
      
      reader.readAsDataURL(file);
    }
  });

</script>
  