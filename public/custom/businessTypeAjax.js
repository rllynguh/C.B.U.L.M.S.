
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
    $.get(url + '/' + myId + '/edit', function (data) {
      $('#btnSave').val('Edit');
      changeLabel();
      $('#myId').val(data.id);
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
    if($("#IsActive").is(':checked'))
      value=1;
    else
      value=0;
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
      data: {checked : value},
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
        $.notify(data[1] + " is in use.", "delete");
      }else{
        table.draw();
        $.notify(data + " has been deleted!", "success");
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


myId="";
$(this).on('click', '#btnAddRequirement',function(e)
{
  $(this).attr('disabled','');
  setTimeout(function(){
    $("#btnAddRequirement").removeAttr('disabled');
  }, 500);   
  $("#btnSaveReq").val('add');
  $('#labelReq').text('Add Requirement(s)');
  $('#buttonReq').text('Add');
  myId=$(this).val();
  $("#idReq").val(myId);
  req="";
  $.get(url + '/showRequirements/' + myId, function (data) 
  {
    if(Object.keys(data).length>0)
    {
      $("#modalRequirement").modal("show");
      $.each( data, function( index, value ){
        req+="<input id='checkboxReq' name='checkboxReq[]' value='" + 
        value.id +"'' type='checkbox'>" + value.description + "<br>";
      });
      $("#divReq").append(req);
    }
    else
    {
      $.notify("No available requirement", "error");
    }
  });
});
$(this).on('click', '#btnEditRequirement',function(e)
{
  $(this).attr('disabled','');
  setTimeout(function(){
    $("#btnEditRequirement").removeAttr('disabled');
  }, 1000);   
  $("#btnSaveReq").val('edit');
  $('#labelReq').text('Edit Requirement(s)');
  $('#buttonReq').text('Save Changes');
  myId=$(this).val();
  $("#idReq").val(myId);
  req="";
  $.get(url + '/showCurrentRequirements/' + myId, function (data) 
  {
    if(Object.keys(data).length>0)
    {
      $("#modalRequirement").modal("show");
      $.each( data, function( index, value ){
        req+="<input id='checkboxReq' name='checkboxReq[]' value='" + 
        value.id +"'' type='checkbox' checked>" + value.description + "<br>";
      });
      $("#divReq").append(req);
    }
    else
    {
      $.notify("You haven't added any requirements.", "error");
    }
  });
});
$(this).on('click','#btnSaveReq', function (e) 
{
 if($('#frmRequirement').parsley().isValid())
 {
  e.preventDefault(); 
  if($(this).val()=='add')
  {
    var my_url = urlstorereq;
    var type="POST";
  }
  else if($(this).val()=='edit')
  {
    var my_url = urlupdatereq;
    var type="PUT";
  }
  formData = $('#frmRequirement').serialize();
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
      $('#modalRequirement').modal('hide');
    },
    error: function (data) {
      console.log('Error:', data.responseText);
      try{
        $('#txtDesc').parsley().removeError('ferror', {updateClass: false});
        $('#txtDesc').parsley().addError('ferror', {message: data.responseText, updateClass: false});
      }catch(err){}
      finally{
        $.each(xhrPool, function(idx, jqXHR) {
          jqXHR.abort();
        });
      }
    }
  });
}
});
$(document).on('hidden.bs.modal','#modalRequirement', function () 
{
  $('#divReq').empty();
});
});



