$(document).ready(function()
{ 
  balance=0;
  beforeInput=''; 
  pdcValue=0;
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
      pdcValue=data[1].pdc_amount;
      $('#user').val(data[1].user_id);
      select='<SELECT id="mode" class="form-control" name="mode"><option value="0">Cash</option>';
      if(data[1].pdc_id!==undefined)
      { 
        $('#pdc_id').val(data[1].pdc_id);
        select+='<option value="1">PDC</option>';
      }
      select+="</SELECT>";
      $('#idSelect').html(select);
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
        content+="Total: ₱ " + data[1].cost + "     Balance: ₱ " + data[2];  
        $('#divCollect').html(content);
      }
      else
       $.notify("No Items can be collected", "error");
   });
  });


  $(document).on('hidden.bs.modal','#modalCollection', function () {
    $('#frmCollection').trigger('reset');
    $('#pdc_id').val('')
    $('#idOption').html('');
    $('#txtAmount').removeAttr('readonly')
  });


  $('#btnSave').on('click',function(e)
  {
    if($('#frmCollection').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
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
          $('#modalCollection').modal('hide');
          if(parseFloat($('#txtAmount').val()) > parseFloat(balance))
          {
            $('#modalBalance').modal('show');
            $('#balance').val((parseFloat($('#txtAmount').val()) - parseFloat(balance)));
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



  $('#btnBalance').on('click',function(e)
  {

    e.preventDefault(); 
    var my_url = url + "/1";
    var type="PUT";
    var formData = $('#frmBalance').serialize();
    $.ajax({
      beforeSend: function (jqXHR, settings) {
        xhrPool.push(jqXHR);
      },
      type: type,
      url: my_url,
      data: formData,
      success: function (data) {
        table.draw(); 
        $('#modalBalance').modal('hide');
        $('#frmBalance').trigger('reset');
      },
      error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
  }
  );



  $(this).on('change', '#mode',function(e){
    if($('#mode').val()==0)
    {
      $('#txtAmount').val(beforeInput);
      $('#txtAmount').removeAttr('readonly')
      $('#pdc_id').val('');
    }
    else
    { 
      beforeInput=$('#txtAmount').val();
      $('#txtAmount').val(pdcValue);
      $('#txtAmount').attr('readonly','')
    }
  });


  function successPrompt(){
    title="File(s) Successfully Uploaded.";
    $.notify(title, "success",
    {
      timer:1000
    });
  }

});