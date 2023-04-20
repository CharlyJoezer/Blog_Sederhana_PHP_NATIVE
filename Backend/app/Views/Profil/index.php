<?php 
require_once '../Backend/app/Views/Template/head.php';
require_once '../Backend/app/Views/Template/navbar.php';
?>

<div class="content">
    <div class="header-profil">
        <div class="profil-data">
            <div class="profil-image">
                <img src="/profil/user/image?image=<?= $_SESSION['image'] ?>" alt="">
            </div>
            <div class="profil-name"><?= $auth['username'] ?></div>
        </div>
        <div class="info-account">
            <div class="post-count">
                <div class="count">0</div>
                <div class="text-count">Postingan</div>
            </div>
            <div class="follower-count">
                <div class="count"><?= $data['user']['jm'] ?></div>
                <div class="text-count">Mengikuti</div>
            </div>
            <div class="follow-count">
                <div class="count"><?= $data['user']['jd'] ?></div>
                <div class="text-count">Diikuti</div>
            </div>
        </div>
        <div class="profil-setting">
            <div class="btn-ep">Edit Profil</div>
        </div>
    </div>

    <div class="wrapper-data-user">
        <div class="header-data-user"><i class="fa-regular fa-image"></i></div>
        <div class="list-post">
            <?php foreach($data['post'] as $item): ?>
                <a class="box-post" href="/postingan/detail?post=<?= $item['id_postingan'] ?>">
                    <div class="post-image">
                        <img src="/postingan/image?image=<?= $item['gambar'] ?>" alt="image" >
                    </div>
                </a>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="box-popup">
    <div class="h-popup">
        <div class="mtext">Edit Profil</div>
        <div class="cls-btn">&#9587;</div>
    </div>
    <div class="c-popup">
        <form action="/profil/edit" method="POST" enctype="multipart/form-data">
            <div class="edt-pp">
                <img id="image-prv" src="/profil/user/image?image=<?= $_SESSION['image'] ?>" alt="">
                <div id="btn-edt-pp">Edit Foto</div>
                <input type="file" id="image-input" name="image" style="width:0px;height:0px;visibility:hidden;">
            </div>
            <hr>
            <div class="edt-username">
                <div class="label">Edit Username</div>
                <div>
                    <input type="text" required name="username" value="<?= $auth['username'] ?>" id="username">
                </div>
            </div>
            <div class="sv-btn">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
    <script>
        $('#btn-edt-pp').click(function(){
            $('#image-input').trigger('click')
        })
        $('#image-input').change(function(){
            console.log('test');
            const file = this.files[0];
            
            if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                $('#image-prv').attr('src', this.result)
            });
            
            reader.readAsDataURL(file);
            }
        })
    </script>
</div>

<script src="/js/profil.js"></script>
<?php 
require_once '../Backend/app/Views/Template/footer.php';
?>