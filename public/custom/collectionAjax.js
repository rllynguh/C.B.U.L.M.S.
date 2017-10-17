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
    {data: 'description'},
    {data: 'code'},
    {data: 'cost'},
    {data: 'amount_paid'},
    {data: 'action'}
    ]
  });
  $(this).on('click', '.btnCollection',function()
  {
    showUrl=url + "/" + $(this).val();
    $('#myId').val($(this).val());
    $(this).attr('disabled','disabled');
    $.get(showUrl, function (data) 
    {
      pdcValue=data[1].pdc_amount;
      $('#user').val(data[1].user_id);
      select='<SELECT name="mode" id="mode" class="form-control" name="mode"><option value="0">Cash</option>';
      console.log(balance);
      if(data[1].pdc_id!==undefined && data[1].forPDC==true && parseFloat(data[1].balance)==parseFloat(data[1].pdc_amount) )
      { 
        $('#pdc_id').val(data[1].pdc_id);
        select+='<option value="1">PDC</option>';
      }
      else if(data[1].for_fund_transfer==true && data[1].forPDC==true)
       select+='<option value="2">Fund Transfer</option>';
     else
      select+='<option value="3">Dated Check</option>';
    select+="</SELECT>";
    $('#idSelect').html(select);
    setTimeout(function(){
      $("#btnCollection" + $('#myId').val()).removeAttr('disabled');
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
    $('#divBank').html('');
    $('#divBank').removeClass('form-line');
    $('#txtAmount').removeAttr('max')
  });


  $('#btnSave').on('click',function(e)
  {
    if($('#frmCollection').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      if(parseFloat($('#txtAmount').val()) > parseFloat(balance))
      { 
        $('#change').val((parseFloat($('#txtAmount').val()) - parseFloat(balance)));
        console.log($('#change').val());
      }
      else
        $('#change').val('');
      var formData = $('#frmCollection').serialize();
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        success: function (data) {
          table.draw(); 
          console.log(balance); 
          $('#modalCollection').modal('hide');
          if(parseFloat($('#txtAmount').val()) > parseFloat(balance))
          {
            console.log(data);
            $('#modalCollection').modal('hide');
            $('#txtChange').text(data);
            $('#modalBalance').modal('show');
            $('#balance').val((parseFloat($('#txtAmount').val()) - parseFloat(balance)));
          }
          else
          { 
            $.notify("Payment Successfully collected.", "success",
            {
              timer:1000
            });
            $('#modalCollection').modal('hide');
          }
          $('#frmCollection').trigger('reset');
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
        $.notify("Your Change has been successfully transferred to your account.", "success",
        {
          timer:1000
        });
      },
      error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
  }
  );



  $(this).on('change', '#mode',function(e){
    $('#divBank').html('');
    $('#divBank').removeClass('form-line');
    $('#txtAmount').removeAttr('readonly');
    $('#txtAmount').removeAttr('max')
    if($('#mode').val()==0)
    {
      $('#txtAmount').val(beforeInput);
      $('#txtAmount').removeAttr('readonly')
    }
    else if($('#mode').val()==1)
    { 
      beforeInput=$('#txtAmount').val();
      $('#txtAmount').val(pdcValue);
      $('#txtAmount').attr('readonly','')
    }
    else if($('#mode').val()==2 || $('#mode').val()==3)
    {
      $('#divBank').addClass('form-line');
      $('#txtAmount').val(beforeInput);
      $('#divBank').html('Bank <select id="bank" class="form-control" name="bank"></select>');
      $.get(bankUrl, function (data) 
      {
       $.each(data, function(e, t) {
        $("#bank").append($("<option>", {
          value: t.id,
          text: t.description
        }));
      });
     });
    }
    else
      $('#txtAmount').attr('max','10000')

  });


  function successPrompt(){
    title="File(s) Successfully Uploaded.";
    $.notify(title, "success",
    {
      timer:1000
    });
  }

});