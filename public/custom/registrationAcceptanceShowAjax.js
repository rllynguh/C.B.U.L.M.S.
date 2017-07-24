
$(document).ready(function()
{ 
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: url,
    columns: [
    {data: 'id'},
    {data: 'description'},
    {data: 'size_range'},
    {data: 'unit_type'},
    {data: 'floor'},
    {data: 'action'},
    ]
  });
  $(this).on('change', '#IsActive',function(e)
  { 
    if($(this).is(":checked")) 
      $(".regi-detail").attr('disabled','disabled');
    else
      $(".regi-detail").removeAttr('disabled','disabled');

  }
  );
  $(this).on('change', '.regi-detail',function(e)
  { 
    myId=$(this).val();
    if($(this).is(":checked")) 
      $("#regi"+myId).val('1');
    else
      $("#regi"+myId).val('0');
  }
  );
  
});