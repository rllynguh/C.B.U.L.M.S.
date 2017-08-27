 
$(document).ready(function()
{ 
   var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'full_name'},
    {data: 'unit_count'},
    {data: 'date_issued'},
    {data: 'action'},
    ]
});
});