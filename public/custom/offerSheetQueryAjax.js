
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
        d.status = $('#status').val()
      }
    },
    columns: [
    {data: 'code'},
    {data: 'tenant'},
    {data: 'full_name'},
    {data: 'unit_offered'},
    {data: 'date_issued'}
    ],
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
  $("#status").change(function(data){
    table.draw();
  });
});