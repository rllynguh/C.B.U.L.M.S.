
$(document).ready(function()
{ 
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'regi_code'},
    {data: 'tenant_description'},
    {data: 'business_type_description'},
    {data: 'regi_count'},
    {data: 'action'},
    ]
  });
  
});