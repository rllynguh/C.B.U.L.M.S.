$(document).ready(function()
{ 
  myId="";
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: dataurl,
      type: "POST"
    },
    columns: [
    {data: 'regi_id'},
    {data: 'offer_id'},
    {data: 'unit_code'},
    {data: 'price'},
    {data: 'building_type'},
    {data: 'unit_size'},
    {data: 'unit_type'},
    {data: 'floor'},
    {data: 'action'}
    ]
  });

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
        if(data.unit_type==0)
          type='Raw';
        else
          type='Shell';
        if(data.detail_remarks==null)
          remarks="";
        else
          remarks=data.detail_remarks;
        info="Offer Sheet Detail: " + data.offer_id + "<br>" +
        "Size offered: " + data.unit_size + "<br>" +
        "Unit Type: " + type + "<br>" +
        "Floor: " + data.floor + "<br>" +
        "Lessor's Remarks: " + remarks; + "<br>"
        ;
        $('#myInfo').append(info);
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
  }
  $('#modalChoose').modal('hide');
});


  $(document).on('hidden.bs.modal','#modalChoose', function () 
  { 
    $("#myInfo").empty();
    $("#modal_remarks").val("");
  });

});