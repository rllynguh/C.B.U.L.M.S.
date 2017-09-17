
$(document).ready(function()
{ 
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: dataurl,
      data: function(d) {
        d.status = $('#status').val(),
        d.business=$('#business').val(),
        d.city=$('#city').val()
      }
    },
    columns: [
    {data: 'regi_code'},
    {data: 'tenant_description'},
    {data: 'business_type_description'},
    {data: 'regi_count'},
    {data: 'date_issued'},
    ],
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
  $("#status").change(function(data){
    table.draw();
  });
  $("#business").change(function(data){
    table.draw();
  });
  $("#city").change(function(data){
    table.draw();
  });
});