
$(document).ready(function()
{ 
  xhrPool=[];
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  //datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'tenant_description'},
    {data: 'business_type_description'},
    {data: 'unit_count'},
    {data: 'action'},
    ]
  });


  $(this).on('click', '#btnReserve',function(e)
  { 
   id=$(this).val();
   $.get(url + '/' + id, function (data) {
    $('#divRes').append("Reservation fee: ₱ " +data);
    $("#myId").val(id);
    $('#modalReserve').modal('show');
  });
 });


  $('#btnSave').on('click',function(e)
  {
    if($('#frmReserve').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      var formData = $('#frmReserve').serialize();
      console.log(formData);
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        success: function (data) {
          console.log(data);
          table.draw();  
          successPrompt(); 
          $('#modalReserve').modal('hide');
        },
        error: function (data) {
          console.log('Error:', data.responseText);
        }
      });
    }}
    );

  function successPrompt(){
    title="Successfully placed reservation";
    $.notify(title, "success",
    {
      timer:1000
    });
  }


  $(document).on('hidden.bs.modal','#modalReserve', function () 
  { 
    $("#divRes").empty();
  });

});