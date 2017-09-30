
$(document).ready(function()
{ 
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'duration_preferred'},
    {data: 'regi_count'},
    {data: 'date_issued'},
    {data: 'tenant_remarks'},
    {data: 'action'},
    ]
});
  
});