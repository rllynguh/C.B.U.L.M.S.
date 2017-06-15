
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
    {data: 'id', name: 'id'},
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
  $('#myList').on('click', '.open-modal',function()
  { 
    var busiType_id = $(this).val();
    $.get(url + '/' + busiType_id + '/edit', function (data) {
            //success data
            console.log(data);
            $('#btnSave').val('Edit');
            changeLabel();
            $('#busiType_id').val(data.id);
            $('#txtBusiTypeDesc').val(data.description);
            $('#myModal').modal('show');
          }) 
  });

  //for storing data or updating data
  $('#btnSave').on('click',function(e)
  { 
    if($("#myForm").parsley().isValid())
     { $.ajaxSetup(
       {
         headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
       })
   e.preventDefault(); 
   var my_url = url;
   var type="POST";
   var formData =$("#myForm").serialize();
   if($('#btnSave').val()=="Edit")
   {
     var busiType_id = $('#busiType_id').val();
     type = "PUT";
     my_url += '/' + busiType_id;
   }
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
      $('#txtBusiTypeDesc').parsley().removeError('ferror', {updateClass: false});
      $('#txtBusiTypeDesc').parsley().addError('ferror', {message: data.responseText, updateClass: false});
    }catch(err){}
    finally{
      $.each(xhrPool, function(idx, jqXHR) {
        jqXHR.abort();
      });
    }
  }
});
 }});

  //for softdeletion of records
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
       console.log(id);
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

  //for deleting records
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
     if(data=="Deleted"){
      $.notify("The record has been deleted by another User!", "success");
      table.draw();
    }else{
      if(data[0]=="true"){
        $.notify(data[1].description + " is in use.", "delete");
      }else{
        table.draw();
        $.notify(data.description + " has been deleted!", "success");
      }
    }
    $("#modalDelete").modal("hide");
  },
  error: function (data) {
   console.log('Error:', data);
 }
});
 });

  //for when the add and edit model gets closed
  $(document).on('hidden.bs.modal','#myModal', function () {
    $("#myForm").trigger("reset");
    $('#txtBusiTypeDesc').parsley().removeError('ferror', {updateClass: false});
    $('#myForm').parsley().destroy();
  });

  //for toggle between add and edit
  function changeLabel()
  {
    btn='<span id="lblButton">SAVE CHANGES</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE BUSINESS TYPE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    if($("#btnSave").val()=="Save")
    {
      btn='<span id="lblButton"> SAVE</span>';
      label=' <h1 id="label" class="modal-title align-center p-b-15">NEW BUSINESS TYPE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    }    
    $('#lblButton').replaceWith(btn);
    $('#label').replaceWith(label);
  }

  //for output of message to user
  function successPrompt(){
   title="Record Successfully Updated!";
   if($("#btnSave").val()=="Save")
    title="Record Successfully Stored!";
  $.notify(title, "success");
}
});



