$('.btn-ep').click(function() {
     $('.box-popup').css('display', 'flex')
     setTimeout(() => {
          $('.box-popup').addClass('active')
     }, 1);

     $('.cls-btn').click(function(){
          $('.box-popup').removeClass('active')
          setTimeout(() => {
               $('.box-popup').css('display', 'none')
               $(body).css('overflow', 'scroll')
          }, 400);
     });
})