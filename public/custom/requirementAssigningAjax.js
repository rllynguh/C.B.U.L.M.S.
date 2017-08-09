$(document).ready(function()
{ 
 var table = $('#myTable').DataTable({
  responsive: true,
  processing: true,
  serverSide: true,
  ajax: dataurl,
  columns: [
  {data: 'code'},
  {data: 'tenant'},
  {data: 'business'},
  {data: 'unit_count'},
  {data: 'action'}
  ]
});
});