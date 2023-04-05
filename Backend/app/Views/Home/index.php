<?php require_once '../Backend/app/Views/Template/head.php' ?>
<?php require_once '../Backend/app/Views/Template/navbar.php' ?>

<div class="content">
  <div class="content-left">
    <div class="list-post">

      <?php foreach($data['post'] as $item): ?>
        <div class="box-post">
          <div class="post-header">
            <div class="posted-by"><?= $item['username'] ?></div>
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
  <!-- <div class="content-right">
    RIGHT
  </div> -->
</div>

<?php require_once '../Backend/app/Views/Template/footer.php' ?>
