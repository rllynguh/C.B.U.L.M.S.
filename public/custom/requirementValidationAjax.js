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
    {data: 'submitted'},
    {data: 'progress'},
    {data: 'action'}
    ]
  });


  $(this).on('click', '#btnShowPendingRequirements',function(e)
  { 
    $.get($(this).val(), function (data) 
    {
     if(Object.keys(data).length>0)
     {
       content="";
       console.log(data);
       $.each( data, function( index, value ){
        content+="<a href='" + url + "/" + value.id + "'>" + value.description + "</a><br>";
      });
       $('#divReq').append(content);
       $('#modalRequirement').modal('show');
     }
     else
       $.notify('The tenant has not yet submitted any documents!');

   });
  });

  $(document).on('hidden.bs.modal','#modalRequirement', function () {
    $("#divReq").empty();
  });

});