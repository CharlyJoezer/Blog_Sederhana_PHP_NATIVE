

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
  
  $("div").find(`[data-class='likes']`).click(function(){
    const sp = $(this).attr('data-status')
    const id_postingan = $(this).attr('attr_postingan')
    if($(this).attr('data-status') == 'false'){
      $(this).removeClass('fa-regular fa-heart')
      $(this).addClass('fa-solid fa-heart')
      $(this).css('color', 'red')
      $(this).attr('data-status', 'true')
    }else{
      $(this).attr('data-status', 'false')
      $(this).removeClass('fa-solid fa-heart')
      $(this).addClass('fa-regular fa-heart')
      $(this).css('color', 'black')
    }
    const thisElement = $(this)
    $.ajax({
      url : '/api/send/like-postingan',
      method : 'POST',
      dataType : 'JSON',
      data : {
        status : sp,
        id_postingan : id_postingan
      },
      statusCode: {
        401: function(){
          thisElement.removeClass('fa-solid fa-heart')
          thisElement.addClass('fa-regular fa-heart')
          thisElement.css('color', 'black')
          $('body').append(`
            <div class="notif" style="background-color:red;">
              Anda belum login!
            </div>
          `)
          setTimeout(() => {
            $('.notif').addClass('show-notif')
          }, 1);
          setTimeout(() => {
              $('.notif').removeClass('show-notif')
          }, 5000);
        }
      },
      error: function(xhr, status, error) {
          console.error("Server Not Responding!");
      }
      
    })
  })

  $('.post-image').dblclick(function(){
    $(this).parent().find('.post-desc').find('.post-info').find('.fa-heart').trigger('click')
  })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>