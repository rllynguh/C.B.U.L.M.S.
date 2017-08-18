
$(document).ready(function()
{
  xhrPool=[];
  //for datatables
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

//for showing add modal
$('#btnAddModal').on('click',function(e)
{ 
  $('#btnSave').val('Save');
  changeLabel();
  $('#myModal').modal('show');
});

  //for showing edit modal
  $('#myList').on('click', '#btnEdit',function()
  { 
    var myId = $(this).val();
    $('#btnSave').val('Edit');
    changeLabel();
    $.get(url + '/' + myId + '/edit', function (data) {
      $('#myForm').trigger("reset");
      $('#myId').val(data.id);
      $('#txtBuilTypeDesc').val(data.description);
      $('#myModal').modal('show');
    }) 
  });

  //for storing new data or updating existing data
  $('#btnSave').on('click',function(e)
  { 
    if($("#myForm").parsley().isValid())
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
      var formData = $("#myForm").serialize();
      if($('#btnSave').val()=="Edit")
      {
        var myId = $('#myId').val();
        type = "PUT";
        my_url += '/' + myId;
      }
                 //for updating existing resource
                 
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
                      $('#txtBuilTypeDesc').parsley().removeError('ferror', {updateClass: false});
                      $('#txtBuilTypeDesc').parsley().addError('ferror', {message: data.responseText, updateClass: false});
                    }catch(err){}
                    finally{
                      $.each(xhrPool, function(idx, jqXHR) {
                        jqXHR.abort();
                      });
                    }
                  }
                });
               }});

  //for softdeletion
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

  //for showing delete modal
  $('#myList').on('click', '.deleteRecord',function(e)
  {
    $("#modalDelete").modal("show");
    $("#btnDelete").val($(this).val());
  });

  //for deleting a record
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
      $.notify(title, "The record has been deleted by another user!","warn");
      table.draw();
    }else{
      if(data[0]=="true"){
        $.notify(data[1] + " is in use.", "error");
      }else{
        table.draw();
        $.notify(data + "successfully deleted!", "success");
      }
    }
    $("#modalDelete").modal("hide");
  },
  error: function (data) {
   console.log('Error:', data);
 }
});
 });

  //for prompting the user
  function successPrompt(){
    title="Record Successfully Updated!";
    if($("#btnSave").val()=="Save")
      title="Record Successfully Stored!";
    $.notify(title, "success");
  }

  //for the toggle for add and edit
  function changeLabel()
  {
    btn='<span id="lblButton"> SAVE CHANGES</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE BUILDING TYPE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    if($("#btnSave").val()=="Save")
    {
      btn='<span id="lblButton"> SAVE</span>';
      label=' <h1 id="label" class="modal-title align-center p-b-15">NEW BUILDING TYPE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    }    
    $('#lblButton').replaceWith(btn);
    $('#label').replaceWith(label);
  }

  //for when the edit/add modal gets closed
  $(document).on('hidden.bs.modal','#myModal', function () {
    $("#myForm").trigger("reset");
    $('#txtBuilTypeDesc').parsley().removeError('ferror', {updateClass: false});
    $('#myForm').parsley().destroy();
  })

});



