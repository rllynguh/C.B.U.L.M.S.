
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
    {data: 'regi_code'},
    {data: 'tenant_description'},
    {data: 'business_type_description'},
    {data: 'regi_count'},
    {data: 'action'},
    ]
  });


  $(this).on('click', '#btnReserve',function(e)
  { 
   id=$(this).val();
   content="";
   $.get(url + '/' + id, function (data) {
    content="<table class='table table-hover dataTable'><thead><tr><th class='align-center'>Unit</th><th class='align-center'>Area</th><th class='align-center'>Price</th> </tr></thead><tbody>"
    $.each( data[1], function( index, value ){
      content+="<tr><td>" + value.code  + "</td> <td>" + value.size  + " sqm</td> <td> " + value.price  + "</td></tr>";
    });
    content+="</tbody></table>";
    content+="<table class='table table-hover dataTable'><thead><tr><th class='align-center'>Particular</th><th class='align-center'>Amount</th></tr></thead><tbody>"
    content+="<tr><td class='align-center'>Base Rent</td> <td class='align-center'>" + data[2].fee  + "</td></tr> <tr><td class='align-center'>+" + data[6].vat_rate + " vat</td>";
    content+="<td class='align-center'>" +  data[4] + "</td></tr>";
    content+="<tr class='align-center'><td>Sub-total</td><td>" + data[5] + "</td></tr>";
    content+="<tr><td class='align-center'>- " + data[6].ewt_rate + " Expanded Witholding Tax</td><td class='align-center'>" + data[3] + "</td></tr>";
    content+="<tr><td class='align-center'>Net Rent</td><td class='align-center'>" + data[7] + "</td></tr></tbody></table>";
    content+="Reservation fee(Net Rent * " + data[2].month + " month(s)): " +data[0];
    $('#divRes').append(content);
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