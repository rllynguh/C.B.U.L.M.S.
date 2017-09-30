$(document).ready(function()
{ 
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  xhrPool=[];
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'tenant'},
    {data: 'progress'},
    {data: 'action'}
    ]
  });

  myId="";
  $(this).on('click', '#btnShowPendingRequirements',function(e)
  { 
    myId=$(this).val();
    $.get(url + "/" + $(this).val() + "/edit", function (data) 
    {
     if(Object.keys(data).length>0)
     {
       content="";
       console.log(data);
       $.each( data, function( index, value ){
        if(value.is_fulfilled==1)
          mode='checked';
        else
          mode='';
        content+="<input type='checkbox' value='" + value.id + "' id='" + value.description + "' name='checkboxReq[]' " + mode + " class='filled-in chk-col-yellow'><label for='" + value.description + "'>" +  value.description + "</label><br>";
      });
       $('#divReq').append(content);
       $('#modalRequirement').modal('show');
     }
     else
       $.notify('The tenant has not yet submitted any documents!');

   });
  });

  $(this).on('click', '#btnSave',function(e)
  {
   if($('#frmRequirement').parsley().isValid())
   {

    e.preventDefault(); 
    var my_url = url + "/" + myId;
    var type="PUT";
    var formData = $('#frmRequirement').serialize();
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
        $('#modalRequirement').modal('hide');
      },
      error: function (data) {
        console.log('Error:', data.responseText);
      }
    });
  }
}
);

  $(document).on('hidden.bs.modal','#modalRequirement', function () {
    $("#divReq").empty();
  });


  function successPrompt(){
   title="Record Successfully Updated!";
   if($("#btnSave").val()=="Save")
    title="Record Successfully Stored!";
  $.notify(title, "success");
}


});