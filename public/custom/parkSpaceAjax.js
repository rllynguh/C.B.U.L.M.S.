$(document).ready(function()
{
  //for house keeping 
  getBuilding();

  var instances;

  //for datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'strBuilDesc', name: 'strBuilDesc'},
    {data: 'intFloorNum', name: 'intFloorNum'},
    {data: 'strParkAreaDesc', name: 'strParkAreaDesc'},
    {data: 'strParkSpaceDesc', name: 'strParkAreaDesc'},
    {data: 'dblParkSpaceSize', name: 'dblParkSpaceSize'},
    {data: 'boolIsActive', name: 'boolIsActive', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  //for showing add modal
  $('#btnAddModal').on('click',function(e)
  { 
    $('#btnSave').val('Save');
    getBuilding();
    changeLabel();
    $('#myModal').modal('show');
    $("#txtPNum").attr("min","1");
    $("#txtArea").attr("min","1");

  });

  //for showing edit modal
  $('#myList').on('click', '.open-modal',function(e)
  {
    $("#btnSave").val("Edit");
    changeLabel();      
    var myId = $(this).val();
    $.get(url + '/' + myId + '/edit', function (data) 
    {
      console.log(data);
      $("#comBuilding").attr("disabled","disabled");
      $("#comParkArea").attr("disabled","disabled");
      var exists = false;
      $('#comBuilding').each(function()
      {
        if (this.value == data.intBuilCode) {
          exists = true;
          return false;
        }});
      if(!exists)
      {
        $('#comBuilding').append($('<option>', {value: data.intBuilCode, text: data.strBuilDesc}));
      }
      $('#comBuilding').val(data.intBuilCode);
      var exists = false;
      $('#comParkArea').each(function(){
        if (this.value == data.intParkAreaCode) 
        {
          exists = true;
          return false;
        }});
      if(!exists)
      {
        $('#comParkArea').append($('<option>', {value: data.intParkAreaCode, text: data.strParkAreaDesc + " (Floor# " + data.intFloorNum + ")"}));
      }
      $('#comParkArea').val(data.intParkAreaCode);
      getLatest();
      $('#myId').val(data.intParkSpaceCode);
      $('#txtPNum').val(parseInt(data.intParkSpaceNumber));
      console.log(jQuery.type($('#txtPNum').val()) + $('#txtPNum').val());
      $('#txtArea').val(parseFloat(data.dblParkSpaceSize));
      $('#myModal').modal('show');
    }); 
  });

  //for storing or updating record
  $('#btnSave').on('click',function(e)
  {
    if($('#myForm').parsley().isValid())
    {
      $("#btnSave").attr('disabled','disabled');
      setTimeout(function(){
        $("#btnSave").removeAttr('disabled');
      }, 1000);
      myId=$("#myId").val();
      console.log(myId);
      my_url=url;
      $.ajaxSetup(
      {
        headers: 
        {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = $("#myForm").serialize();
      console.log(formData);
    type = "PUT"; //for updating existing resource
    my_url += '/' + myId;
    if($("#btnSave").val()=="Save")
    {
      type="POST"
      my_url=url;
    }
    $.ajax(
    {
      type: type,
      url: my_url,
      data: formData,
      dataType: 'json',
      success: function (data) 
      {
        console.log(data);
        table.draw();
        successPrompt();
        if($("#btnSave").val()=="Save")
        {
          getBuilding();
          $("#txtPNum").val("");
          $("#txtArea").val("");
        }
        else
        {
          $('#myModal').modal('hide');
        }              
      },
      error: function (data) 
      {
        console.log('Error:', data);
      }
    });
  }
});

  //for softdeletion
  $('#myList').on('change', '#IsActive',function(e)
  { 
    $.ajaxSetup(
    {
      headers: 
      {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
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

  //for prompting the user
  function successPrompt(){
   title="Record Successfully Updated!";
   if($("#btnSave").val()=="Save")
    title="Record Successfully Stored!";
  $.notify(title, "success",
  {
    timer:1000
  });
}

//for querying available building
function getBuilding()
{
  $.get(url + '/get/building', function (data) 
  {
    console.log(data);
    selected=$("#comBuilding").val();
    $('#comBuilding').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#comBuilding').append($('<option>', {value:value.intBuilCode, text:value.strBuilDesc}));
    });
    if($("#btnSave").val()=="Save")
      $("#comBuilding").val(selected);
    if( !$('#comBuilding').has('option').length > 0  && $("#btnSave").val()=="Save" )    
    { 
      $.notify("No building available!","error");
      $("#myModal").modal("hide");
    }
    else
      getParkArea();
  });
}

// for querying available park area
function getParkArea()
{
  $.get(url + '/getParkArea/' + $("#comBuilding").val(), function (data) 
  {
    console.log($("#comBuilding").val());
    // selected=$("#comParkArea").val();
    $('#comParkArea').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#comParkArea').append($('<option>', {value:value.intParkAreaCode, text:value.strParkAreaDesc + " (Floor# " + value.intFloorNum + ")"}));
    });
    getLatest();
  });
}

//for querying latest number of parkspace
function getLatest()
{
  $.get(url + '/getLatest/' + $("#comParkArea").val(), function (data) 
  {
    console.log($("#comParkArea").val());
    var max;
    if($("#btnSave").val()=="Save")
    {
      $("#txtPNum").val(parseInt(data.number));
      if(parseInt(data.number) > parseInt(data.ceiling))
      { 
        $.notify("Number of parking space at maximum");
        $("#myModal").modal("hide");
      }
      else if(parseFloat(data.max)<=0)
      { 
        $.notify("Reached maximum space","error");
        $("#myModal").modal("hide");
      }
      max=parseFloat(data.max);
    }
    else
      max=parseFloat($("#txtArea").val()) + parseFloat(data.max);
    $("#txtArea").attr("max",max);
  });
}

//for toggling between add and edit
function changeLabel()
{
  btn='<span id="lblButton">SAVE CHANGES</span>';
  label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE PARKING SPACE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  if($("#btnSave").val()=="Save")
  {
    btn='<span id="lblButton"> SAVE</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">NEW PARKING SPACE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  }    
  $('#lblButton').replaceWith(btn);
  $('#label').replaceWith(label);
}

//for when the add or edit modal gets closed
$(document).on('hidden.bs.modal','#myModal', function () 
{

  $("#myForm").trigger('reset');
  $('#myForm').parsley().destroy();
  $("#comBuilding").removeAttr("disabled");
  $("#comParkArea").removeAttr("disabled");
  $("#txtArea").removeAttr("max");
});

//fro when user selects building
$("#comBuilding").change(function(data)
{
  getParkArea();
});

//for when user selects park area
$("#comParkArea").change(function(data)
{
  getLatest();
});

});