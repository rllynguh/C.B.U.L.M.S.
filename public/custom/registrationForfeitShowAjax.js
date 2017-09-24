
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
    if($(this).hasClass('bg-orange'))//currently active
    {
      $('#modalChoose').modal('show');
    }
    else//currently forfeited
    {
      $("#regi"+myId).val('0');
      $('#status'+myId).removeClass('bg-red');
      $('#status'+myId).addClass('bg-orange');
      $('#lblStatus'+myId).text('Active');
      $(this).text('FORFEIT');
    }
  });


  $(this).on('click', '#btnForfeit',function(e) //forfeits a registration detail
  { 
    $("#regi"+myId).val('1');
    $('#status'+myId).removeClass('bg-orange');
    $('#status'+myId).addClass('bg-red');
    $('#lblStatus'+myId).text('Forfeited');
    $('#modalChoose').modal('hide');
    $('#status'+myId).text('UNDO'); 
  });



  $(document).on('hidden.bs.modal','#modalChoose', function () 
  { 
    $("#detail_remarks").val("");
  });

});