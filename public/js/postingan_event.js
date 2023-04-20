
// LIKE POSTINGAN

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
              setTimeout(() => {
                 $('.notif').remove()
              }, 500)
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

// GET COMMENT
$("div").find(`[data-class='comment']`).click(function(){
  $('.list-cmt').html('')
  $('.btn-send-cmt').attr('attr-postingan',$(this).attr('attr-postingan')); 
  $('.box-popup').css('display', 'flex')
  $('body').css('overflow-y', 'hidden')
  setTimeout(() => {
    $('.box-popup').addClass('active')
  }, 1);

  $.ajax({
    url:'/api/postingan/get-comment',
    method: 'POST',
    dataType: 'JSON',
    data: {
      id: $(this).attr('attr-postingan')
    },
    success: function(data){
      if(data.data.length == 0){
        $('.list-cmt').html('<div class="cmt-null">Belum ada comment!</div>')
      }else{
        for(i = 0; i < data.data.length; i++)
        $('.list-cmt').append(`
        <div class="box-cmt">
          <div><img src="/profil/user/image?image=`+data.data[i]['foto_profil']+`" alt=""></div>
          <div class="user-desc">
            <div class="usr-name">`+data.data[i]['username']+`</div>
            <div class="cmt-text">`+data.data[i]['comment']+`</div>
          </div>
        </div>
        `)
      }
    }
  })
  
  $('.cls-btn').click(function(){
    $('.box-popup').removeClass('active')
    setTimeout(() => {
        $('.box-popup').css('display', 'none')
        $('body').css('overflow-y', 'scroll')
        }, 400);
  });
})

// SEND COMMENT
$('.btn-send-cmt').click(function(){
  const getComment = $('#input-comment').val()
  if(getComment.replace(/ /g, '') == ''){
    return false;
  }
  $('#input-comment').val('')
  $.ajax({
    url:'/api/postingan/send-comment',
    method: 'POST',
    dataType: 'JSON',
    data: {
      id: $(this).attr('attr-postingan'),
      comment: getComment
    },
    success:function(){
      $('.cls-btn').trigger('click')
    }
  })
})