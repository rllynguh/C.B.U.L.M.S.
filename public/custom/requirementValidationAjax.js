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


  $(this).on('click', '#btnShowPendingRequirements',function(e)
  { 
    $.get($(this).val(), function (data) 
    {
      content="";
      console.log(data);
      $.each( data, function( index, value ){
        content+="<a href='" + url + "/" + value.id + "'>" + value.description + "</a><br>";
      });
      $('#divReq').append(content);
      $('#modalRequirement').modal('show');
    });
  });

});