<?php require_once '../Backend/app/Views/Template/head.php' ?>
<?php require_once '../Backend/app/Views/Template/navbar.php' ?>

<div class="content">
    <div class="list-post">

      <?php foreach($data['post'] as $item): ?>
        <div class="box-post">
          <div class="post-header">
            <img src="https://i0.wp.com/dianisa.com/wp-content/uploads/2022/08/18.-Profil-WA-Kosong.jpg?resize=1000%2C580&ssl=1" alt="">
            <div class="posted-by"><?= $item['username'] ?></div>
          </div>
          <div class="post-image">
            <img src="/postingan/image?image=<?= $item['gambar'] ?>" alt="">
          </div>
          <div class="post-desc">
            <div class="post-info">
              <i class="fa-regular fa-heart"></i> 
              <i class="fa-regular fa-comment-dots"></i>  
            </div>
            <div class="post-caption">
              <div class="post-by"><?= $item['username'] ?></div>
              <div class="caption-text"><?= $item['caption'] ?></div>
              <div class="post-time"><?= date('l j F Y H:i', strtotime($item['created_at']) )  ?></div>
            </div>
          </div>
        </div>
      <?php endforeach;?>

    </div>
</div>

<?php require_once '../Backend/app/Views/Template/footer.php' ?>
