
$(document).ready(function()
{ 

  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'intBankCode', name: 'intBankCode'},
    {data: 'strBankDesc', name: 'strBankDesc'},
    {data: 'boolIsActive', name: 'boolIsActive', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
  function changeLabel()
  {
   btn='<span id="lblButton">SAVE Changes</span>';
   label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE BANK<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
   if($("#btnSave").val()=="Save")
   {
    btn='<span id="lblButton"> SAVE</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">NEW ACCREDITED BANK<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  }    
  $('#lblButton').replaceWith(btn);
  $('#label').replaceWith(label);
}
$(document).on('hidden.bs.modal','#myModal', function () 
{ 
  $('#txtBankDesc').parsley().removeError('ferror', {updateClass: false});
  $("#myForm").trigger("reset");
  $('#myForm').parsley().destroy();
});

$('#myList').on('click', '.open-modal',function()
{ 
  var myId = $(this).val();
  $.get(url + '/' + myId + '/edit', function (data) 
  {
//success data
console.log(data);
if(data=="Deleted")
{
 $.notify("The Record has been deleted by another user.", "warning");
 table.draw();
}
else
{
  $('#btnSave').val('Edit');
  changeLabel();
  $('#myId').val(data.intBankCode);
  $('#txtBankDesc').val(data.strBankDesc);
  $('#myModal').modal('show');
}
}) 
});
//delete task and remove it from list
$('#myList').on('click', '.deleteRecord',function(e)
{
  $("#modalDelete").modal("show");
  $("#btnDelete").val($(this).val());
});
$('#btnDelete').on('click',function(e)
{
 $.ajaxSetup({
  headers: {
   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
 }
})

 e.preventDefault(); 
 var builType_id = $(this).val();
 $.ajax({
  url: url + '/' + builType_id,
  type: "delete",
  success: function (data) {
    console.log(data);
    if(data=="Deleted"){
      $.notify("The Record has been deleted by another user.", "warning");
      table.draw();
    }else{
      if(data[0]=="true"){
        $.notify( data[1].strBankDesc + " is in use.", "warning");
      }else{
        table.draw();
        $.notify(data.strBankDesc + " successfully deleted.", "success");
      }
    }
    $("#modalDelete").modal("hide");
  },
  error: function (data) {
   console.log('Error:', data);
 }
});
});

$('#btnAddModal').on('click',function(e)
{ 
  $('#btnSave').val('Save');
  changeLabel();
  $('#myModal').modal('show');
});

//create new task / update existing task
$('#btnSave').on('click',function(e)
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
    if($('#btnSave').val()=="Edit")
    {
      var myId = $('#myId').val();
      type = "PUT";
      my_url += '/' + myId;
    }
//for updating existing resource
xhrPool=[];
console.log(formData);
$.ajax({
  beforeSend: function (jqXHR, settings) {
    xhrPool.push(jqXHR);
  },
  type: type,
  url: my_url,
  data: formData,
  dataType: 'json',
  success: function (data) {
    console.log(data);
    table.draw();  
    successPrompt(); 
    $('#myModal').modal('hide');
  },
  error: function (data) {
    console.log('Error:', data.responseText);
    try{
      $('#txtBankDesc').parsley().removeError('ferror', {updateClass: false});
      $('#txtBankDesc').parsley().addError('ferror', {message: data.responseText, updateClass: false});
    }catch(err){}
    finally{
      $.each(xhrPool, function(idx, jqXHR) {
        jqXHR.abort();
      });
    }
  }
});
}}
);
$('#myList').on('change', '#IsActive',function(e)
{ 
  $.ajaxSetup(
  {
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  })
  e.preventDefault(); 
  var id = $(this).val();
  $.ajax(
  {
    url: url + '/softDelete/' + id,
    type: "POST",
    success: function (data) 
    {
      console.log(id);
    },
    error: function (data) 
    {
      console.log('Error:', data);
    }
  });
});
function successPrompt(){
  title="Record Successfully Updated!";
  if($("#btnSave").val()=="Save")
    title="Record Successfully Stored!";
  $.notify(title, "success",
  {
    timer:1000
  });
}
}
);


