
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
        d.days = $('#days').val()
      }
    },
    columns: [
    {data: 'tenant'},
    {data: 'location'},
    {data: 'unit_code'},
    {data: 'size'},
    {data: 'rate'},
    {data: 'rent'},
    {data: 'lease_period'},
    ],
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
  table.buttons().container()
  .appendTo( $('#bebiko') );
  $("#days").change(function(data){
    table.draw();
    console.log($(this).val());
  });
  $("#business").change(function(data){
    table.draw();
  });
  $("#city").change(function(data){
    table.draw();
  });
});