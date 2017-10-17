
$(document).ready(function()
{

  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })


  $(this).on('click', '.notification',function(e)
  { 
    value=$(this).attr('id');
    notifUrl=$(this).attr('href');
    console.log(notifUrl);

    e.preventDefault(); 
    $.ajax({
      type: "PUT",
      url: readNotifUrl,
      data: { id : value },
      success: function (data) {
        if(notifUrl=="javascript:void(0);")
        {
          list="";
          $.each(data.list, function(index,value){
           list+=
           '<li>' +
           '<a href="javascript:void(0);" id="' + value.id + '"" class="notification waves-effect waves-block">'+
           '<div class="menu-info">' +
           '<h4>' + value.title +'</h4>' +
           '<p>' +
           '<i class="mdi-action-schedule"></i> ' + value.date_issued + 
           '</p>' +
           '</div>' +
           '</a>' +
           '</li>';
         });
          $('#notif_count').text(data.count);
          $('#notifBody').html(list);
        }
        else
          window.location.href = notifUrl;
      },
      error: function (data) {
      }
    });
  }
  );

}
);


