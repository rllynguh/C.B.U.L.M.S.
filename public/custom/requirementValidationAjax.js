$(document).ready(function()
{ 
  xhrPool=[];
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'tenant'},
    {data: 'business'},
    {data: 'progress'},
    {data: 'action'}
    ]
  });



});