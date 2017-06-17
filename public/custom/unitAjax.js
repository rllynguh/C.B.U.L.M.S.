$(document).ready(function()
{
  //for datatables
  xhrPool=[];
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'description', name: 'description'},
    {data: 'floor_number', name: 'floor_number'},
    {data: 'unit_code', name: 'unit_code'},
    {data: 'type', name: 'type'},
    {data: 'unit_number', name: 'unit_number'},
    {data: 'size', name: 'size'},
    {data: 'is_active', name: 'is_active', searchable: false},
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
  });

  //for showing edit modal
  $('#myList').on('click', '.open-modal',function(e)
  {      
    var myId = $(this).val();
    $.get(url + '/' + myId + '/edit', function (data) 
    {
    //success data
    $("#btnSave").val("Edit");
    changeLabel();
    console.log(data);
    $("#comBuilding").attr("disabled","disabled");
    $("#comFloor").attr("disabled","disabled");
    var exists = false;
    $('#comBuilding').each(function()
    {
      if (this.value == data.building_id) {
        exists = true;
        return false;
      }});
    if(!exists)
    {
      $('#comBuilding').append($('<option>', {value: data.building_id, text: data.description}));
    }
    $('#comBuilding').val(data.building_id);
    var exists = false;
    $('#comFloor').each(function(){
      if (this.value == data.floor_id) 
      {
        exists = true;
        return false;
      }});
    if(!exists)
    {
      $('#comFloor').append($('<option>', {value: data.floor_id, text: data.number}));
    }
    $('#comFloor').val(data.floor_id);
    $('#myId').val(data.id);
    $('#txtUNum').val(data.number);
    $('#txtArea').val(data.size);
    $('#comUnitType').val(data.type);
  }); 
    $('#myModal').modal('show');
  });

  //for updating or storing new record
  $("#btnSave").click(function (e) {
    if($("#myForm").parsley().isValid())
    {
      myId=$("#myId").val();
      console.log(myId);
      my_url=url;
      $("#btnSave").attr('disabled','disabled');
      setTimeout(function(){
        $("#btnSave").removeAttr('disabled');
      }, 1000);
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
      type="POST";
      my_url=url;
    }
    $.ajax(
    {
     beforeSend: function (jqXHR, settings) {
      xhrPool.push(jqXHR);
    },
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

  //for record soft deletion
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
        console.log(data);
      },
      error: function (data) 
      {
        console.log('Error:', data);
      }
    })
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

//for toggling between add and edit
function changeLabel()
{
  btn='<span id="lblButton">SAVE CHANGES</span>';
  label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE UNIT<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  if($("#btnSave").val()=="Save")
  {
    btn='<span id="lblButton"> SAVE</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">NEW UNIT<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
  }    
  $('#lblButton').replaceWith(btn);
  $('#label').replaceWith(label);
}

//for when add/edit modal gets closed
$(document).on('hidden.bs.modal','#myModal', function () 
{
  $('#myForm').parsley().destroy();
  $("#myForm").trigger('reset');
  $("#comBuilding").removeAttr("disabled");
  $("#comFloor").removeAttr("disabled");
});

//for querying list of buildings
function getBuilding()
{
  $.get(url + '/get/building', function (data) 
  {
    console.log(data);
    selected=$("#comBuilding").val();
    $('#comBuilding').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#comBuilding').append($('<option>', {value:value.id, text:value.description}));
    });
    $("#comBuilding").val(selected);
    if( !$('#comBuilding').has('option').length > 0  && $("#btnSave").val()=="Save" ) 
    { 
      alert("No building available.")
      $("#myModal").modal("hide");
    }
    getFloor();
  });
}

//for when user selects a building
$("#comBuilding").change(function(data)
{
  getFloor();
});

//for when user selects floor
$("#comFloor").change(function(data)
{
  getLatest();
});

//for querying latest floor number
function getFloor()
{
  $.get(url + '/getFloor/' + $("#comBuilding").val(), function (data) 
  {
    console.log(data);
    selected=$("#comFloor").val();
    $('#comFloor').children('option').remove();
    $.each(data,function(index,value)
    {
      $('#comFloor').append($('<option>', {value:value.id, text:value.number}));
    });
    $("#comFloor").val(selected);
    getLatest();
  });
}

// for querying latest unit number
function getLatest()
{
  $.get(url + '/getLatest/' + $("#comFloor").val(),function(data)
  {
    console.log(data);
    $("#txtUNum").val(data.number);
  });
}
});