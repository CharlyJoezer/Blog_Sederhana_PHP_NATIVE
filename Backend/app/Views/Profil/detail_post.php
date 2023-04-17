<?php 
require_once '../Backend/app/Views/Template/head.php';
require_once '../Backend/app/Views/Template/navbar.php';
?>
<div class="box-post">
     <div class="post-header">
          <div class="posted-by">
               <img src="https://i0.wp.com/dianisa.com/wp-content/uploads/2022/08/18.-Profil-WA-Kosong.jpg?resize=1000%2C580&ssl=1" alt="">
               <div><?= $data['post']['username'] ?></div>    
          </div>
          <?php if(isset($_SESSION['login'])):?>
               <?php if($data['post']['user_id'] == $_SESSION['id']):?>
                    <div class="gear-option" style="cursor:pointer;position:relative;z-index:1;">
                         <i class="fa-solid fa-ellipsis-vertical"></i>
                         <div class="popup-delete">
                              <a href="/postingan/delete?delete=<?= $data['post']['id_postingan'] ?>" class="d-flex align-items-center">
                                   <div>Hapus</div>
                              </a>
                         </div>
                    </div>
               <?php endif;?>
          <?php endif;?>
     </div>
     <div class="post-image">
          <img src="/postingan/image?image=<?= $data['post']['gambar'] ?>" alt="">
     </div>
     <div class="post-desc">
          <div class="post-info">
          <?php if(!isset($data['post']['userlike_id'])):?>
               <i class="fa-regular fa-heart" data-class="likes" data-status="false" attr_postingan="<?= $data['post']['id_postingan'] ?>"></i> 
          <?php else:?>
               <i class="fa-solid fa-heart" style="color:red;" data-class="likes" data-status="true" attr_postingan="<?= $data['post']['id_postingan'] ?>"></i> 
          <?php endif;?>        
          <i class="fa-regular fa-comment-dots"></i>      
          </div>
     <div class="post-caption">
          <div class="post-by"><?= $data['post']['username'] ?></div>
          <div class="caption-text"><?= $data['post']['caption'] ?></div>
          <div class="post-time"><?= date('l j F Y H:i', strtotime($data['post']['created_at']) )  ?></div>
     </div>
     </div>
</div>

<script src="/js/postingan_event.js"></script>
<?php 
require_once '../Backend/app/Views/Template/footer.php';
?>