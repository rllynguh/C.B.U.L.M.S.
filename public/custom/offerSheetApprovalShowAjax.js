$(document).ready(function()
{ 
  myId="";

  $(this).on('click', '.btnChoose',function(e)
  { 
    myId=$(this).val();
    if($(this).val()=='header')
    {
      $("#modal_remarks").val($("#header_remarks").val());
      info="Client's Remarks: " + header_remarks;
      $('#myInfo').append(info);
    }
    else
    {  
      $("#modal_remarks").val($("#remarks"+myId).val());
      $.get(mainUrl + '/' + $(this).val() + '/edit', function (data) 
      {
        console.log(data);
        $('#unit_code').text(data.unit_code);
        $('#half_address').text(data.half_address);
        $('#city_province').text(data.city_province);
        $('#rate').text(data.rate);
        $('#unit_img').attr('src', dir+"/"+data.picture);
        $('#building').text(data.building);
        $('#ordered_building_type').text(data.ordered_building_type);
        $('#offered_building_type').text(data.offered_building_type);
        $('#ordered_unit_type').text(data.ordered_unit_type);
        $('#offered_unit_type').text(data.offered_unit_type);
        $('#ordered_size_range').text(data.ordered_size_range);
        $('#offered_size').text(data.offered_size);
        $('#ordered_floor').text(data.ordered_floor);
        $('#offered_floor').text(data.offered_floor);
      }); 
    }
    setTimeout(function(){
      $('#modalChoose').modal('show');
    }, 1000);
  });


  $(this).on('click', '#btnAccept',function(e)
  { 
    if(myId=="header")
    {
      $("#header_remarks").val($("#modal_remarks").val());
      $("#header_is_active").val('1');
    }
    else
    { 
      $("#remarks"+myId).val($("#modal_remarks").val());
      $("#offer"+myId).val('1');
      $('#lblStatus'+myId).text('Accepted');
      $('#status'+myId).removeClass('bg-orange');
      $('#status'+myId).addClass('bg-ligh-green');
    }
    $('#modalChoose').modal('hide');
  });


  $(this).on('click', '#btnReject',function(e)
  { 
   if(myId=="header")
   {
    $("#header_remarks").val($("#modal_remarks").val());
    $("#header_is_active").val('2');
  }
  else
  { 
    $("#remarks"+myId).val($("#modal_remarks").val())
    $("#offer"+myId).val('2');
    $('#lblStatus'+myId).text('Rejected');
    $('#status'+myId).removeClass('bg-ligh-green');
    $('#status'+myId).addClass('bg-orange');
  }
  $('#modalChoose').modal('hide');
});


  $(document).on('hidden.bs.modal','#modalChoose', function () 
  { 
    $("#myInfo").empty();
    $("#modal_remarks").val("");
  });

});