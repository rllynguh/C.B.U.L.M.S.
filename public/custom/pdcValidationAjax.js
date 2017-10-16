
$(document).ready(function()
{ 
  xhrPool=[];
  status='';
  // $('#divTable').slimscroll({
  //   height : '500px'
  // });
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'description'},
    {data: 'date_issued'},
    {data: 'action'},
    ]
  });
  //datatables


  $('#btnAccept').on('click',function(e)
  {
    e.preventDefault(); 
    var my_url = url +"/" +$('#myId').val();
    var type="PUT";
    $('#status').val('1');
    var formData = $('#frmPDCValidation').serialize();
    $.ajax({
      beforeSend: function (jqXHR, settings) {
        xhrPool.push(jqXHR);
      },
      type: type,
      url: my_url,
      data: formData,
      success: function (data) {
        $('#modalPDCValidation').modal('hide');
        $.notify('PDC Successfully verified','info');
        table.draw();
      },
      error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
  });
  $('#btnReject').on('click',function(e)
  {
    e.preventDefault(); 
    var my_url = url +"/" +$('#myId').val();
    var type="PUT";
    $('#status').val('2');
    var formData = $('#frmPDCValidation').serialize();
    $.ajax({
      beforeSend: function (jqXHR, settings) {
        xhrPool.push(jqXHR);
      },
      type: type,
      url: my_url,
      data: formData,
      success: function (data) {
        $('#modalPDCValidation').modal('hide');
        $.notify('PDC Successfully rejected','info');
        table.draw();
      },
      error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
  });
  $(this).on('click', '#btnShow',function(e)
  {   
    $('#myId').val($(this).val());
    content="";
    $.get(url + '/' + $('#myId').val(), function (data) 
    {
      content+="Check :" + data.code + "<br>" +
      "Bank :" + data.description + "<br>" +
      "Amount :" + data.amount + "<br>" +
      "Applicable Month :" + data.for_date;
      $('#content').html(content);
      $('#modalPDCValidation').modal('show');
    }
    );
  }
  );

  function successPrompt(){
    title="Successfully Collected PDC";
    $.notify(title, "success",
    {
      timer:1000
    });
  }




  $(document).on('hidden.bs.modal','#modalPDCCollection', function () 
  { 
          //for hiding button and removeing readonly for enabling inputs fablisly  
          $('#frmPDC').trigger('reset');
          $('#btnSaveTable').attr('type','hidden');
          $('#txtPDC').removeAttr('readonly');
          $('#bank').removeAttr('disabled');
          $('#txtCode').removeAttr('readonly');
          $('#btnSave').attr('type','submit');
          $('#divTable').html('');
        });

});