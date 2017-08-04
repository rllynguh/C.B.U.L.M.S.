
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
    {data: 'regi_count'},
    {data: 'duration_preferred'},
    {data: 'date_issued'},
    {data: 'tenant_remarks'},
    {data: 'action'},
    ]
  });
  
});