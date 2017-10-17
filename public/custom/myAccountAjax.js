
$(document).ready(function()
{ 
  xhrPool=[];

  //show add modal
  $('#btnShow').on('click',function(e)
  { 
    $('#withdrawModal').modal('show');
  });


  //store new data or update existing data
  $('#btnWithdraw').on('click',function(e)
  {
    if($('#myForm').parsley().isValid())
    {
      $.ajaxSetup(
      {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      var formData = $('#myForm').serialize();
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        success: function (data) {
          successPrompt(); 
          $('#withdrawModal').modal('hide');
          $('#balance').html(data.value);
        },
        error: function (data) {
          console.log('Error:', data.responseText);
        }
      });
    }}
    );

//for prompting a message to the user
function successPrompt(){
  title="Record Successfully Updated!";
  if($("#btnSave").val()=="Save")
    title="Record Successfully Stored!";
  $.notify(title, "success",
  {
    timer:1000
  });
}

//for when the modal of add and edit was closed
$(document).on('hidden.bs.modal','#myModal', function () 
{ 
  $('#txtBankDesc').parsley().removeError('ferror', {updateClass: false});
  $("#myForm").trigger("reset");
  $('#myForm').parsley().destroy();
});

}
);


