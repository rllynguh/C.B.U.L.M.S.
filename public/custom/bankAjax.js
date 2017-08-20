
$(document).ready(function()
{ 
  xhrPool=[];
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'description', name: 'description'},
    {data: 'is_active', name: 'is_active', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  //show add modal
  $('#btnAddModal').on('click',function(e)
  { 
    $('#btnSave').val('Save');
    changeLabel();
    $('#myModal').modal('show');
  });

  //show edit modal
  $('#myList').on('click', '#btnEdit',function()
  { 
    var myId = $(this).val();
    $.get(url + '/' + myId + '/edit', function (data) 
    {
      if(data=="Deleted")
      {
       $.notify("The Record has been deleted by another user.", "warning");
       table.draw();
     }
     else
     {
      $('#btnSave').val('Edit');
      changeLabel();
      $('#myId').val(data.id);
      $('#txtBankDesc').val(data.description);
      $('#myModal').modal('show');
    }
  }) 
  });

  //store new data or update existing data
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
      $.ajax({
        beforeSend: function (jqXHR, settings) {
          xhrPool.push(jqXHR);
        },
        type: type,
        url: my_url,
        data: formData,
        success: function (data) {
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

  //soft delete a record
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
      url: url + '/softdelete/' + id,
      type: "PUT",
      success: function (data) 
      {
      },
      error: function (data) 
      {
        console.log('Error:', data);
      }
    });
  });

  //show delete modal
  $('#myList').on('click', '.deleteRecord',function(e)
  {
    $("#modalDelete").modal("show");
    $("#btnDelete").val($(this).val());
  });

  //delete a record
  $('#btnDelete').on('click',function(e)
  {
   $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
   }
 })

   e.preventDefault(); 
   var myId = $(this).val();
   $.ajax({
    url: url + '/' + myId,
    type: "delete",
    success: function (data) {
      if(data=="Deleted"){
        $.notify("The Record has been deleted by another user.", "warning");
        table.draw();
      }else{
        if(data[0]=="true"){
          $.notify( data + " is in use.", "warning");
        }else{
          table.draw();
          $.notify(data + "'s record has been deleted successfully.", "success");
        }
      }
      $("#modalDelete").modal("hide");
    },
    error: function (data) {
     console.log('Error:', data);
   }
 });
 });

  //for changing output for buttons of edit and add
  function changeLabel()
  {
   btn='<span id="lblButton"> SAVE CHANGES</span>';
   label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE BANK<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
   if($("#btnSave").val()=="Save")
   {
    btn='<span id="lblButton"> SAVE</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">NEW ACCREDITED BANK<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  }    
  $('#lblButton').replaceWith(btn);
  $('#label').replaceWith(label);
}

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


