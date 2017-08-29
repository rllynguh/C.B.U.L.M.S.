$(document).ready(function()
{ 
  balance=0; 
  // for computation 
  xhrPool=[];
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'cost'},
    {data: 'amount_paid'},
    {data: 'action'}
    ]
  });
  $(this).on('click', '#btnCollection',function()
  {
    showUrl=url + "/" + $(this).val();
    $('#myId').val($(this).val());
    $(this).attr('disabled','disabled');
    $.get(showUrl, function (data) 
    {
      setTimeout(function(){
        $("#btnCollection").removeAttr('disabled');
      }, 1000);
      if(Object.keys(data).length>0)
      {
        balance=data[1].balance;
        content=" <table class='table table-hover dataTable'id=''><thead><tr><th class='align-center'>DESCRIPTION</th><th class='align-center'>AMOUNT DUE</th></tr></thead><tbody id='myList'>";
        $("#modalCollection").modal("show");
        $.each( data[0], function( index, value ){
          content+="<tr>" +
          "<td>" + value.description + "</td>" +
          "<td> ₱ " + value.price + "</td>" +
          "</tr>";
        });
        content+="</tbody></table>";
        content+="Total: ₱ " + data[1].cost + "     Balance: ₱ " + data[1].balance;  
        $('#divCollect').append(content);
      }
      else
       $.notify("No Items can be collected", "error");
   });
  });


  $(document).on('hidden.bs.modal','#modalCollection', function () {
    $("#divCollect").empty();
  });


  $('#btnSave').on('click',function(e)
  {
    if($('#frmCollection').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      if(parseFloat($('#txtAmount').val()) > parseFloat(balance))
        $('#txtAmount').val(parseFloat(balance));
      var formData = $('#frmCollection').serialize();
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
          console.log(balance); 
          if(parseFloat($('#txtAmount').val()) > parseFloat(balance))
          {
            $.notify("Payment Successfully collected. Change is ₱ " + (parseFloat($('#txtAmount').val()) - parseFloat(balance)) + ".", "success",
            {
              timer:1000
            });
          }
          else
           $.notify("Payment Successfully collected.", "success",
           {
            timer:1000
          });
         $('#frmCollection').trigger('reset');
         $('#modalCollection').modal('hide');
       },
       error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
    }}
    );


  function successPrompt(){
    title="File(s) Successfully Uploaded.";
    $.notify(title, "success",
    {
      timer:1000
    });
  }

});