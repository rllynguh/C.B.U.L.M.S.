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
    {data: 'name'},
    {data: 'unit_count'},
    {data: 'pending_items'},
    {data: 'action'}
    ]
  });
  $(this).on('click', '#btnShowRequirements',function()
  {
    showUrl=$(this).val();
    $(this).attr('disabled','disabled');
    $.get(showUrl, function (data) 
    {
      setTimeout(function(){
        $("#btnShowRequirements").removeAttr('disabled');
      }, 1000);
      if(Object.keys(data).length>0)
      {
        content="";
        $("#modalShowRequirements").modal("show");
        $.each( data, function( index, value ){
          if(value.status==1)
            status="<small class='label label-success'>Fulfilled</small>"
          else
            status="<small class='label label-warning'>Pending</small>"
          content+=" " + value.description + " " + status + "<br>";
        });
        $('#divRequirements').append(content);
      }
      else
       $.notify("No Requirements Assigned", "error");
   });
  });


  $(document).on('hidden.bs.modal','#modalShowRequirements', function () {
    $("#divRequirements").empty();
  });


  $(this).on('click', '#btnShowPendingRequirements',function()
  {
    $('#regi_id').val($(this).val());
    showUrl=url +"/showPendingReqirements/" + $(this).val();
    $(this).attr('disabled','disabled');
    $.get(showUrl, function (data) 
    {
      setTimeout(function(){
        $("#btnShowPendingRequirements").removeAttr('disabled');
      }, 1000);
      if(Object.keys(data).length>0)
      {
        content="";
        $("#modalShowPendingRequirements").modal("show");
        ctr=0;
        console.log(data);
        $.each( data, function( index, value ){
          content+=value.description + " " +
          "<input type='file' required='' name='pdf" + ctr +"'>" + 
          "<input type='hidden' name='requirements[]' value='" + value.id  + "'>";
          ctr++;
        });
        $('#divPendingRequirements').append(content);
      }
      else
       $.notify("No Requirements Assigned", "error");
   });
  });


  $(document).on('hidden.bs.modal','#modalShowPendingRequirements', function () {
    $("#divPendingRequirements").empty();
  });



  $('#btnSaveRequirements').on('click',function(e)
  {
    if($('#frmSubmitRequirements').parsley().isValid())
    {

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      var formData = new FormData($('#frmSubmitRequirements')[0]);
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
          $('#modalShowPendingRequirements').modal('hide');
        },
        error: function (data) {
          console.log('Error:', data.responseText);
        }
      });
    }}
    );


  function successPrompt(){
    title="Record Successfully Updated!";
    if($("#btnSave").val()=="Save")
      title="Record Successfully Stored!";
    $.notify(title, "success",
    {
      timer:1000
    });
  }

});