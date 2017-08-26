$(document).ready(function()
{ 
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
    {data: 'balance'},
    {data: 'amount_paid'},
    {data: 'action'}
    ]
  });
  $(this).on('click', '#btnCollection',function()
  {
    showUrl=$(this).val();
    $(this).attr('disabled','disabled');
    $.get(showUrl, function (data) 
    {
      setTimeout(function(){
        $("#btnCollection").removeAttr('disabled');
      }, 1000);
      if(Object.keys(data).length>0)
      {
        content=" <table class='table table-hover dataTable'id=''><thead><tr><th class='align-center'>DESCRIPTION</th><th class='align-center'>AMOUNT DUE</th><th class='align-center'>AMOUNT COLLECTED</th></tr></thead><tbody id='myList'>";
        $("#modalCollection").modal("show");
        $.each( data, function( index, value ){
          content+="<tr>" +
          "<td>" + value.description + "</td>" +
          "<td> ₱ " + value.balance + "</td>" +
          "<td>" + "<input name='billings[]' type='hidden' value='" +  value.id + "'>₱ <input type='number' name='payments[]' max='" + value.balance +  "'></td>" +
          "</tr>";
        });
        content+="</tbody></table>";
        $('#divCollect').append(content);
      }
      else
       $.notify("No Requirements Assigned", "error");
   });
  });


  $(document).on('hidden.bs.modal','#modalCollection', function () {
    $("#divCollect").empty();
  });


  $('#btnSaveRequirements').on('click',function(e)
  {
    if($('#frmCollection').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      var formData = $('frmCollection').serialize();
      console.log(formData);
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
          console.log(data);
          table.draw();  
          successPrompt(); 
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