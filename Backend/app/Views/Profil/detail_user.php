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
            <div class="profil-name"><?= $data['user']['username'] ?></div>
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
        <?php if(isset($_SESSION['login'])):?>
            <?php if($data['user']['id_user'] != $_SESSION['id']):?>
                <?php if($data['user']['check_flw'] == null):?>
                    <div class="w-bf">
                        <div class="bf" id="bf" attr_id="<?= $data['user']['id_user'] ?>"><i class="fa-solid fa-user-plus"></i>Ikuti</div>
                    </div>
                <?php else:?>
                    <div class="w-bf">
                        <div class="bf already" id="bf" attr_id="<?= $data['user']['id_user'] ?>"><i class="fa-solid fa-user-minus"></i>Hapus</div>
                    </div>
                <?php endif;?>
            <?php endif;?>
    <?php endif;?>
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


<script type="text/javascript" src="/js/detail_profil.js"></script>
<?php 
require_once '../Backend/app/Views/Template/footer.php';
?>