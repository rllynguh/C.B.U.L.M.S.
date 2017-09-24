
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
    $("#detail_remarks").val($("#remarks"+myId).val());
    $('#modalChoose').modal('show');
  });


  $(this).on('click', '#btnAccept',function(e)
  { 
    $("#remarks"+myId).val($("#detail_remarks").val());
    $("#regi"+myId).val('0');
    $('#status'+myId).removeClass('bg-orange');
    $('#status'+myId).addClass('bg-light-green');
    $('#lblStatus'+myId).empty();
    $('#lblStatus'+myId).append('Accepted');
    $('#modalChoose').modal('hide');
  });


  $(this).on('click', '#btnReject',function(e)
  { 
    $("#remarks"+myId).val($("#detail_remarks").val())
    $("#regi"+myId).val('1');
    $('#status'+myId).removeClass('bg-light-green');
    $('#status'+myId).addClass('bg-orange');
    $('#lblStatus'+myId).empty();
    $('#lblStatus'+myId).append('Rejected');
    $('#modalChoose').modal('hide');
  });


  $(document).on('hidden.bs.modal','#modalChoose', function () 
  { 
    $("#regi_info").empty();
    $("#detail_remarks").val("");
  });

});