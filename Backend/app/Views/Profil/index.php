<?php 
require_once '../Backend/app/Views/Template/head.php';
require_once '../Backend/app/Views/Template/navbar.php';
?>

<div class="content">
    <div class="header-profil">
        <div class="profil-data">
            <div class="profil-image">
                <img src="https://i0.wp.com/dianisa.com/wp-content/uploads/2022/08/18.-Profil-WA-Kosong.jpg?resize=1000%2C580&ssl=1" alt="">
            </div>
            <div class="profil-name"><?= $auth['username'] ?></div>
        </div>
        <div class="info-account">
            <div class="post-count">
                <div class="count">0</div>
                <div class="text-count">Postingan</div>
            </div>
            <div class="follower-count">
                <div class="count">0</div>
                <div class="text-count">Mengikuti</div>
            </div>
            <div class="follow-count">
                <div class="count">0</div>
                <div class="text-count">Diikuti</div>
            </div>
        </div>
    </div>

    <div class="wrapper-data-user">
        <div class="header-data-user"><i class="fa-regular fa-image"></i></div>
        <div class="list-post">
            <?php foreach($data['post'] as $item): ?>
                <div class="box-post">
                    <div class="post-image">
                        <img src="/postingan/image?image=<?= $item['gambar'] ?>" alt="image" >
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>


<script src="/js/postingan_event.js"></script>
<?php 
require_once '../Backend/app/Views/Template/footer.php';
?>