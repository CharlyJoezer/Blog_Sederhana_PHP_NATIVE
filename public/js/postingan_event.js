
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