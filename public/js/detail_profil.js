$('#bf').click(function(){
     const id = $(this).attr('attr_id')
     $.ajax({
          url : '/api/follow',
          method: 'POST',
          dataType: 'JSON',
          data: {
               id : id
          },
          statusCode: {
               401:function(data){
                    alert(data.message)
                    return false;
               },
               404:function(data){
                    alert(data.message)
                    return false;
               },
               500:function(data){
                    alert(data.message)
                    return false;
               },
               200:function(data){
                    if(data.status == true){
                         $('#bf').addClass('already')
                         $('#bf').html('<i class="fa-solid fa-user-minus"></i> Hapus')
                    }else if(data.status == false){
                         $('#bf').removeClass('already')
                         $('#bf').html('<i class="fa-solid fa-user-plus"></i> Ikuti')
                    }
               }
          },
     })
});