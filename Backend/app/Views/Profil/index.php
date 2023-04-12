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
        <div class="header-data-user">Postingan Kamu</div>
        <div class="list-post">

            <?php foreach($data['post'] as $item): ?>
            <div class="box-post">
                <div class="post-header">
                    <div class="posted-by">
                    <img src="https://i0.wp.com/dianisa.com/wp-content/uploads/2022/08/18.-Profil-WA-Kosong.jpg?resize=1000%2C580&ssl=1" alt="">
                    <div><?= $item['username'] ?></div>    
                    </div>
                    <div class="gear-option" style="cursor:pointer;position:relative;z-index:1;">
                        <i class="fa-solid fa-gear"></i>
                        <div class="popup-delete">
                            <a href="/postingan/delete?delete=<?= $item['id_postingan'] ?>" class="d-flex align-items-center">
                                <div>Hapus</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="post-image">
                    <img src="/postingan/image?image=<?= $item['gambar'] ?>" alt="">
                </div>
                <div class="post-desc">
                <div class="post-caption">
                    <div class="post-by"><?= $item['username'] ?></div>
                    <div class="caption-text"><?= $item['caption'] ?></div>
                    <div class="post-time"><?= date('l j F Y H:i', strtotime($item['created_at']) )  ?></div>
                </div>
                <div class="post-info">
                    <div><i class="fa-regular fa-thumbs-up"></i> Likes</div>
                    <div><i class="fa-solid fa-cloud-arrow-down"></i> Download</div>
                </div>
                </div>
            </div>
            <?php endforeach;?>

        </div>
    </div>
</div>



<?php 
require_once '../Backend/app/Views/Template/footer.php';
?>