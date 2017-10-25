
$(document).ready(function()
{ 
  xhrPool=[];
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })

  //show add modal
  $('#btnModal').on('click',function(e)
  { 
    $('#modalRegistration').modal('show');
  });

  //store new data or update existing data
  $('#btnSave').on('click',function(e)
  {
    if($('#frmRegistration').parsley().isValid())
    {
      e.preventDefault(); 

      e.preventDefault(); 
      var my_url = url;
      var type="POST";
      var formData = $('#frmRegistration').serialize();
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        success: function (data) {  
          successPrompt(); 
          $('#modalRegistration').modal('hide');
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
$(document).on('hidden.bs.modal','#modalRegistration', function () 
{ 
  $("#frmRegistration").trigger("reset");
  $('#frmRegistration').parsley().destroy();
});

}
);


