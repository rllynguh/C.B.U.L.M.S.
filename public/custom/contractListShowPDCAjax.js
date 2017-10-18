$(document).ready(function() {
  console.log('hello');
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  table= $("#myTable").DataTable({
    responsive: !0,
    processing: !0,
    serverSide: !0,
    ajax: dataurl,
    columns: [ {
      data: "code"
    }, {
      data: "status"
    } , {
      data: "for_date"
    }, {
      data: "description"
    }, {
      data: "amount"
    }, {
      data: "signatory"
    } , {
      data: "action"
    }]
  });

  $(this).on('click', '#btnEditPDC',function()
  { 
    var myId = $(this).val();
    $.get(url + '/' + myId + '/editPDC', function (data) 
    {
      $('#myId').val(data.id);
      $('#bank').val(data.bank_id);
      $('#code').val(data.code);
      $('#amount').val(data.amount);
      $('#for_date').val(data.for_date);
      $('#signatory').val(data.signatory);
      $('#myModal').modal('show');
    }) 
  });

  $(this).on('click', '#btnShowDetails',function()
  { 
    var myId = $(this).val();
    $.get(url + '/' + myId + '/usedPDC', function (data) 
    {
      content="";
      $('#dispBank').text(data.pdc.bank);
      $('#dispPDC').text(data.pdc.pdc);
      $('#dispAmount').text(data.pdc.amount);
      $('#dispFor_date').text(data.pdc.for_date);
      $('#dispBilling').text(data.pdc.billing);
      $('#dispPayment').text(data.pdc.payment);
      $('#dispSignatory').text(data.pdc.signatory);

      $.each( data.details, function( index, value ){
        content+="<tr><td>" + value.description  + "</td> <td>" + value.price + "</td></tr>";
      });
      $('#myList').html(content);
      $('#modalDetails').modal('show');
    }) 
  });

  $('#btnSave').on('click',function(e)
  {
    myId=$('#myId').val();
    formData=$('#myForm').serialize();
    if($('#myForm').parsley().isValid())
    {
      e.preventDefault();
      $.ajax({
        type: "PUT",
        url: url +"/" + myId +"/updatePDC",
        data: formData,
        success: function (data) {
          table.draw();  
          successPrompt(); 
          $('#myModal').modal('hide');
        },
        error: function (data) {
          console.log('Error:', data.responseText);
        }
      });
    }}
    );

    //for prompting a message to the user
    function successPrompt(){
      title="PDC Successfully Updated!";
      $.notify(title, "success",
      {
        timer:1000
      });
    }
  });