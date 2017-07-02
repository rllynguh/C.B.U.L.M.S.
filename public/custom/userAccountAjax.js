
$(document).ready(function()
{ 
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'strUserName', name: 'strUserName'},
    {data: 'email', name: 'email'},
    {data: 'last_login', name: 'last_login'},
    {data: 'type', name: 'type'},
    {data: 'is_active', name: 'is_active', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
  $('#myList').on('change', '#IsActive',function(e)
  { 
    $.ajaxSetup(
    {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    })
    e.preventDefault(); 
    var id = $(this).val();
    $.ajax(
    {
      url: url + '/active/' + id,
      type: "PUT",
      success: function (data) 
      {
        console.log(id);
      },
      error: function (data) 
      {
        console.log('Error:', data);
      }
    });
  });


    //show delete modal
    $('#myList').on('click', '.deleteRecord',function(e)
    {
      $("#modalDelete").modal("show");
      $("#btnDelete").val($(this).val());
    });

  //delete a record
  $('#btnDelete').on('click',function(e)
  {
   $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
   }
 })

   e.preventDefault(); 
   var myId = $(this).val();
   $.ajax({
    url: url + '/' + myId,
    type: "delete",
    success: function (data) {
      console.log(data);
      if(data=="Deleted"){
        $.notify("The Record has been deleted by another user.", "warning");
        table.draw();
      }else{
        if(data[0]=="true"){
          $.notify( data[1].description + " is in use.", "warning");
        }else{
          table.draw();
          $.notify(data.description + "'s record has been deleted successfully.", "success");
        }
      }
      $("#modalDelete").modal("hide");
    },
    error: function (data) {
     console.log('Error:', data);
   }
 });
 });
});