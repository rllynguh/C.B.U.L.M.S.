
$(document).ready(function()
{ 
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'id', name: 'id'},
    {data: 'tenant_description', name: 'tenant_description'},
    {data: 'business_type_description', name: 'business_type_description'},
    ]
  });
  
});