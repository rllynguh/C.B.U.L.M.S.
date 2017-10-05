
$(document).ready(function()
{ 
  $('#divTable').slimscroll({
    height : '300px'
  });
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
  xhrPool=[];
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  //datatables


  $(this).on('click', '#btnPdc',function(e)
  { 
    e.preventDefault();
    content="";
    $.get($(this).val(), function (data) {
      $('#txtPDC').attr('max',data[1].max); //get PDC Count 12-current pdc count
      $('#txtCode').val(data[1].code); //get latest PDC Code      
      content="<table class='table table-hover dataTable'><thead><tr><th class='align-center'>DESCRIPTION</th><th class='align-center'>COST</th> </tr></thead><tbody>";
      $.each( data[0], function( index, value ){
        content+="<tr><td>" + value.description  + "</td> <td>" + value.price + "</td></tr>";
      });
      content+="<tr><td class='align-right'><b>Total</> </td> <td><b>" + data[1].totalDisplay + "</b></td></tr>";
      content+="</tbody></table><br>";
      $('#divBill').html(content);
      $("#myId").val(data[1].id);
      $("#amount").val(data[1].total);
      $('#modalPDCCollection').modal('show');
    });
  });


  $('#btnSave').on('click',function(e)
  {
    e.preventDefault(); 
    if($('#frmPDC').parsley().isValid())
    {

      var my_url = url;
      var type="POST";
      var formData = $('#frmPDC').serialize();
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        dataType: "json",
        success: function (data) {
          //for hiding button and readonly for disabling inputs fablisly  
          $('#txtPDC').attr('readonly','');
          $('#bank').attr('disabled','');
          $('#txtCode').attr('readonly','');
          $('#btnSave').attr('type','hidden');
          table.draw();
          successPrompt(); 
          divTable='<h4>Amount:</h4>'+data[1];
          divTable+="<table id='pdcTable' class='table table-hover'><thead><tr><th class='align-center'>CODE</th><th class='align-center'>MONTH</th><th class='align-center'>DATE ACCEPTED</th><th class='align-center'>BANK</th> </tr></thead><tbody id='myList'></tbody>";
          $.each( data[0], function( index, value ){
            divTable+="<tr><td class='codes' id='" + value.id + "'>" + value.code + "</td><td>" + value.for_date + "</td><td>" + value.date_accepted + "</td><td>" + value.bank + "</td></tr>";
            divTable+="<input type='hidden' id='code" + value.id + "' name='codes[]'>";
            divTable+="<input type='hidden' value='" + value.id + "' name='ids[]'>";
          });
          divTable+='</table>';
          $('#divTable').html(divTable);
          $('#pdcTable').editableTableWidget({ editor: $('<input>'), preventColumns: [ 2,3] });
  //editable table plugin disable 2nd and 3rd column
  value=$('#frmPDC').serialize();
},
error: function (data) {
  console.log('Error:', data.responseText);
}
});
    }
    else
      console.log('hello');
  }
  );

  function successPrompt(){
    title="Successfully Collected PDC";
    $.notify(title, "success",
    {
      timer:1000
    });
  }

  $('#btnSaveTable').on('click',function(e)
  {
    e.preventDefault();//no unnecessary redirection

    $('.codes').each(function(){ //reiterating all the codes and passing to the input
      index=$(this).attr('id');
      $('#code'+index).val($(this).text());
    });
    $.ajax({
      beforeSend: function (jqXHR, settings) {
        xhrPool.push(jqXHR);
      },
      type: 'PUT',
      url: update,
      data: $('#frmPDC').serialize(),
      success: function (data) {
        $.notify('Successfully updated PDC','success');
        $('#modalPDCCollection').modal('hide');
      },
      error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
  });

  $(this).on('change','.codes', function () 
  {
    $('#btnSaveTable').attr('type','submit');
  }
  );

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