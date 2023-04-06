

<div class="wrapper-load" style="display:none;">
  <div class="load">
    <hr/><hr/><hr/><hr/>
  </div>
</div>

<?php if(isset($_SESSION['message'])):?>
  <div class="notif" style="<?php if(isset($_SESSION['message']['fail'])):?> background-color:red;  @endif display:flex;align-items:center;<?php endif; ?>">
          <?php if(isset($_SESSION['message']['success'])):?>
              <div><i class="fa-solid fa-circle-check" style="font-size:20px;margin-right:10px;"></i></div>
              <div><?= $_SESSION['message']['success'] ?></div>
          <?php endif; ?>

          <?php if(isset($_SESSION['message']['fail'])):?>
              <div><i class="fa-solid fa-triangle-exclamation" style="font-size:20px;margin-right:10px;"></i></div>
              <div><?= $_SESSION['message']['fail'] ?></div>
          <?php endif; ?>
  </div>
<?php endif; ?>

<script>
  $(document).ready(function(){
    $('.wrapper-load').css('display', 'block');
    $(window).on('load', function() {
      $('.wrapper-load').css('display', 'none');
      function showNotif(){
          $('.notif').addClass('show-notif')
        setTimeout(() => {
            $('.notif').removeClass('show-notif')
        }, 5000);
      }
    
      <?php if(isset($_SESSION['message'])): ?>
        showNotif()
      <?php endif; ?>
    });
  });
  
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>