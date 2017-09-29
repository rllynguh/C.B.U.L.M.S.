
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
    {data: 'description'},
    {data: 'date_issued'},
    {data: 'progress'},
    {data: 'action'},
    ]
  });


  $(this).on('click', '#btnPdc',function(e)
  { 
    e.preventDefault();
    content="";
    console.log($(this).val());
    $.get($(this).val(), function (data) {
      $('#txtPDC').attr('max',data[1].max);
      content="<table class='table table-hover dataTable'><thead><tr><th class='align-center'>Description</th><th class='align-center'>Cost</th> </tr></thead><tbody>";
      $.each( data[0], function( index, value ){
        content+="<tr><td>" + value.description  + "</td> <td>" + value.price + "</tr>";
      });
      content+="<tr><td class='align-right'><b>Total</> </td> <td><b>" + data[1].totalDisplay + "</b></tr>";
      content+="</tbody></table><br>";
      $('#divBill').html(content);
      $("#myId").val(data[1].id);
      $("#amount").val(data[1].total);
      $('#modalPDC').modal('show');
    });
  });


  $('#btnSave').on('click',function(e)
  {
    if($('#frmPDC').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      var formData = $('#frmPDC').serialize();
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
          $('#modalPDC').modal('hide');
        },
        error: function (data) {
          console.log('Error:', data.responseText);
        }
      });
    }}
    );

  function successPrompt(){
    title="Successfully Collected PDC";
    $.notify(title, "success",
    {
      timer:1000
    });
  }


  $(document).on('hidden.bs.modal','#modalPDC', function () 
  { 
    $('#frmPDC').trigger('reset');
  });

});