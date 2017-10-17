
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
        d.building = $('#building').val(),
        d.checkBuilding = $('#checkBuilding').val(),
        d.floor = $('#floor').val(),
        d.checkFloor = $('#checkFloor').val()
      }
    },
    columns: [
    {data: 'description', name: 'description'},
    {data: 'floor_number', name: 'number'},
    {data: 'unit_code', name: ' units.code'},
    {data: 'type', name: 'units.type'},
    {data: 'size'},
    {data: 'price'},
    {data: 'location'},
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

  $(this).on('click', '#btnGenerate',function(e)
  { 
    e.preventDefault();
    console.log( $('#checkBuilding').val());
    table.draw();
  });
});