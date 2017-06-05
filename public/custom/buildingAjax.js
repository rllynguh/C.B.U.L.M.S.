
$(document).ready(function()
{
  //for house keeping
  getCity();
  xhrPool=[];
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'strBuilCode', name: 'strBuilCode'},
    {data: 'strBuilDesc', name: 'strBuilDesc'},
    {data: 'strCityDesc', name: 'strCityDesc'},
    {data: 'boolIsActive', name: 'boolIsActive', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  //for showing floor add modal
  $('#myList').on('click', '#btnAddFloor',function()
  { 
    $("#comBuilding").val($(this).val());
    $.get(url + '/' + $(this).val() + '/edit', function (data) {
      $("#txtFBuilDesc").val(data.strBuilDesc);
      getLatest();
      $("#modalFloor").modal("show");  
    });
  });

  //for saving floor record
  $('#btnSaveFloor').on('click',function(e)
  { 
    if($('#frmFloor').parsley().isValid())
    {
      $("#btnSaveFloor").attr('disabled','disabled');
      setTimeout(function(){
        $("#btnSaveFloor").removeAttr('disabled');
      }, 1000);
      $.ajaxSetup(
      {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })
      e.preventDefault(); 
      var formData = $("#frmFloor").serialize(); 
      console.log(formData);
      $.ajax({
        type: "POST",
        url: urlfloor,
        data: formData,
        dataType: 'json',
        success: function (data) {
          console.log(data);
          getLatest();
          $.notify("Record Successfully Stored!", "success");
          $("#txtUNum").val("");
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }});

  //for showing building add modal
  $('#btnAddModal').on('click',function(e)
  { 
    $('#btnSave').val('Save');
    changeLabel();
    $('#myModal').modal('show');
  });

  //for showing building edit modal
  $('#myList').on('click', '.open-modal',function()
  { 
    var myId = $(this).val();
    $.get(url + '/' + myId + '/edit', function (data) {
            //success data
            $('#btnSave').val('Edit');
            changeLabel();
            console.log(data);
            if(parseInt(data.current)==0)
              value="1";
            else
              value=data.current;
            $("#txtBFNum").attr("min",value);
            $("#comBuilType").attr("disabled","");
            $('#myId').val(data.intBuilCode);
            var exists = false;
            $('#comBuilType').each(function(){
              if (this.value == data.intBuilTypeCode) {
                exists = true;
                return false;
              }
            });
            if(!exists)
            { 
              $('#comBuilType').append($('<option>', {value: data.intBuilTypeCode, text: data.strBuilTypeDesc}));
              $('#comBuilType').val(data.intBuilTypeCode);
            }
            $('#comBuilType').val(data.intBuilTypeCode);
            $('#txtBuilDesc').val(data.strBuilDesc);
            $('#txtBFNum').val(data.intBuilNumOfFloor);
            $('#txtSNum').val(data.strAddrNum);
            $('#txtStreet').val(data.strAddrStreet);
            $('#txtDistrict').val(data.strAddrDistrict);
            $('#comCity').val(data.intCityCode);
            $('#comProvince').val(data.intProvinceCode);
            $('#myModal').modal('show');
          }) 
  });

  //for updating or storing records
  $('#btnSave').on('click',function()
  { 
    if($('#myForm').parsley().isValid())
    {
      $("#btnSave").attr('disabled','disabled');
      setTimeout(function(){
        $("#btnSave").removeAttr('disabled');
      }, 1000);
      $.ajaxSetup(
      {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })
      var my_url = url;
      var type="POST";
      var formData = $("#myForm").serialize();
      if($('#btnSave').val()=="Edit")
      {
        var myId = $('#myId').val();
        type = "PUT";
        my_url += '/' + myId;
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
          $('#txtBuilDesc').parsley().removeError('ferror', {updateClass: false});
          $('#txtBuilDesc').parsley().addError('ferror', {message: data.responseText, updateClass: false});
        }catch(err){}
        finally{
          $.each(xhrPool, function(idx, jqXHR) {
            jqXHR.abort();
          });
        }
      }
    });
    }});

  //for soft delete
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

  //for deleting record
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
        $.notify("The record has been deleted by another user!", "boom");
        table.draw();
      }else{
        if(data[0]=="true"){
          $.notify(data[1].strBuilDesc + " is in use!", "boom");
        }else{
          table.draw();
          $.notify(data.strBuilDesc + " successfully deleted.", "boom");
        }
      }
      $("#modalDelete").modal("hide");
    },
    error: function (data) {
     console.log('Error:', data);
   }
 });
 });

  //for prompting user
  function successPrompt(){
   title="Record Successfully Updated!";
   if($("#btnSave").val()=="Save")
    title="Record Successfully Stored!";
  $.notify(title, "success");
}

//for querying latest number of unit
function getLatest()
{
  $.get(url +'/getFloor/' + $("#comBuilding").val(), function (data) 
  {
    if(parseInt(data.max)<parseInt(data.current))
    {
      $.notify("Number of floors at maximum!", "error");
      $("#modalFloor").modal("hide");
    }
    else
    {
      console.log(data);
      $("#txtFNum").val(data.current);
    }
  });

}

//for toggle between edit and add
function changeLabel()
{
  btn='<span id="lblButton">SAVE CHANGES</span>';
  label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE BUILDING<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  if($("#btnSave").val()=="Save")
  {
    btn='<span id="lblButton"> SAVE</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">NEW BUILDING<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  }    
  $('#lblButton').replaceWith(btn);
  $('#label').replaceWith(label);
}

//for querying list of city
function getCity()
{
  $.get('/custom/getCity/' + $("#comProvince").val(), function (data) {
    console.log(data);
    $('#comCity').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#comCity').append($('<option>', {value:value.intCityCode, text:value.strCityDesc}));
    });
  });
}

//for querying city when user selects province
$("#comProvince").change(function(data){
  getCity();
});

//for when building modal gets closed
$(document).on('hidden.bs.modal','#myModal', function () {
  $('#txtBuilDesc').parsley().removeError('ferror', {updateClass: false});
  $('#myForm').parsley().destroy();
  $("#myForm").trigger('reset');
  $("#comBuilType").removeAttr("disabled");
  $("#txtBFNum").attr("min","1");
});

//for when floor modal gets closed
$(document).on('hidden.bs.modal','#modalAddFloor', function () {
  $('#frmFloor').parsley().destroy();
  $("#frmFloor").trigger('reset');
});
});



