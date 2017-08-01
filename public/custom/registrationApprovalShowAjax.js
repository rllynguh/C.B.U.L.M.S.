
$(document).ready(function()
{ 
  //datatables
  myId='';
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: showUrl,
    columns: [
    {data: 'id'},
    {data: 'description'},
    {data: 'size_range'},
    {data: 'unit_type'},
    {data: 'floor'},
    {data: 'action'},
    ]
  });
  $(this).on('click', '.btnChoose',function(e)
  { 
    myId=$(this).val();
    if($(this).val()=='header')
    {
      $("#detail_remarks").val($("#header_remarks").val());
      info="Client's Remarks: " + header_remarks;
      $('#regi_info').append(info);
    }
    else
    {  
      $("#detail_remarks").val($("#remarks"+myId).val());
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
        info="Registration Detail: " + data.description + "<br>" +
        "Size ranging from: " + data.size_range + "<br>" +
        "Unit Type: " + type + "<br>" +
        "Floor: " + data.floor + "<br>" +
        "Client's Remarks: " + remarks; + "<br>"
        ;
        $('#regi_info').append(info);
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
      $("#header_remarks").val($("#detail_remarks").val());
      $("#header_is_active").val('1');
    }
    else
    { 
      $("#remarks"+myId).val($("#detail_remarks").val());
      $("#regi"+myId).val('0');
    }
    $('#modalChoose').modal('hide');
  });


  $(this).on('click', '#btnReject',function(e)
  { 
   if(myId=="header")
   {
    $("#header_remarks").val($("#detail_remarks").val());
    $("#header_is_active").val('2');
  }
  else
  { 
    $("#remarks"+myId).val($("#detail_remarks").val())
    $("#regi"+myId).val('1');
  }
  $('#modalChoose').modal('hide');
});


  $(document).on('hidden.bs.modal','#modalChoose', function () 
  { 
    $("#regi_info").empty();
    $("#detail_remarks").val("");
  });

});