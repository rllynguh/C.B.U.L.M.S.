
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

    e.preventDefault(); 
    $.ajax({
      type: "PUT",
      url: url,
      data: { id : value },
      success: function (data) {
        list="";
        $.each(data.list, function(index,value){
          list+=
          '<li>'
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
        console.log(list);
      },
      error: function (data) {
      }
    });
  }
  );

}
);


