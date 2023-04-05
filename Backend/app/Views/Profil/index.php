<?php 
require_once '../Backend/app/Views/Template/head.php';
require_once '../Backend/app/Views/Template/navbar.php';
?>

<div class="content">
    <div class="header-profil">
        <div class="profil-data">
            <div class="profil-image">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRePoVhTeaks5ESIWqL34k8BOO9Wh6UZdZECw&usqp=CAU" alt="">
            </div>
            <div class="profil-name"><?= $auth['username'] ?></div>
        </div>
    </div>

    <div class="wrapper-data-user">
        <div class="header-data-user">Postingan Kamu</div>
        <div class="list-post">

            <?php foreach($data['post'] as $item): ?>
            <div class="box-post">
                <div class="post-header">
                    <div class="posted-by"><?= $item['username'] ?></div>
                    <div style="cursor:pointer;"><i class="fa-solid fa-gear"></i></div>
                </div>
                <div class="post-image">
                    <img src="/postingan/image?image=<?= $item['gambar'] ?>" alt="">
                </div>
                <div class="post-desc">
                <div class="post-caption">
                    <div class="post-by"><?= $item['username'] ?></div>
                    <div class="caption-text"><?= $item['caption'] ?></div>
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