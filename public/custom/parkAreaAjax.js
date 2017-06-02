$(document).ready(function()
{
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
      $("#comBuilding").val(selected);
      if( !$('#comBuilding').has('option').length > 0  && $("#btnSave").val()=="Save" ) 
      { 
        alert("No building available.");
        $("#myModal").modal("hide");
      }
      getFloor();
    });
  }
  function getFloor()
  {
    $.get(url + '/getFloor/' + $("#comBuilding").val(), function (data) 
    {
     console.log(data);
     selected=$("#comFloor").val();
     $('#comFloor').children('option').remove();
     $.each(data,function(index,value)
     {
       $('#comFloor').append($('<option>', {value:value.intFloorCode, text:value.intFloorNum}));
     });
     $("#comFloor").val(selected);
   });
  }
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'strBuilDesc', name: 'strBuilDesc'},
    {data: 'strParkAreaDesc', name: 'strParkAreaDesc'},
    {data: 'intFloorNum', name: 'intFloorNum'},
    {data: 'dblParkAreaSize', name: 'dblParkAreaSize'},
    {data: 'intNumOfSpace', name: 'intNumOfSpace'},
    {data: 'boolIsActive', name: 'boolIsActive', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
  function changeLabel()
  {
    btn='<span id="lblButton">SAVE CHANGES</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE PARK AREA<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    if($("#btnSave").val()=="Save")
    {
      btn='<span id="lblButton"> SAVE</span>';
      label=' <h1 id="label" class="modal-title align-center p-b-15">NEW PARK AREA<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    }    
    $('#lblButton').replaceWith(btn);
    $('#label').replaceWith(label);
  }
  getBuilding();
  $(document).on('hidden.bs.modal','#myModal', function () 
  {
    $("#myForm").trigger('reset');
    $('#myForm').parsley().destroy();
    $("#comBuilding").removeAttr("disabled");
    $("#comFloor").removeAttr("disabled");
  });
  $(document).on('hidden.bs.modal','#modalParkSpace', function () 
  {
    $("#frmParkSpace").trigger('reset');
    $('#frmParkSpace').parsley().destroy();
  });
//display modal form for task editing
$('#myList').on('click', '.open-modal',function(e)
{
  $("#comBuilding").attr("disabled","disabled");
  $("#comFloor").attr("disabled","disabled");
  $("#btnSave").val("Edit");
  changeLabel();  
  var myId = $(this).val();
  $.get(url + '/' + myId + '/edit', function (data) 
  {
    //success data
    value=data.current;
    if(parseInt(data.current)<=1)
      value=1;
    $("#txtPNum").attr("min",value);
    value=data.size;
    if(parseInt(data.size)<=1)
      value=1;
    $("#txtArea").attr("min",value);
    console.log(data);
    
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
    $('#comFloor').each(function(){
      if (this.value == data.intFloorCode) 
      {
        exists = true;
        return false;
      }});
    if(!exists)
    {
      $('#comFloor').append($('<option>', {value: data.intFloorCode, text: data.intFloorNum}));
    }
    console.log("setFLoor");
    $('#comFloor').val(data.intFloorCode);
    $('#myId').val(data.intParkAreaCode);
    $('#txtPNum').val(data.intNumOfSpace);
    $('#txtArea').val(data.dblParkAreaSize);
  }); 
  $('#myModal').modal('show');
});
$('#btnAddModal').on('click',function(e)
{ 
  $('#btnSave').val('Save');
  changeLabel();
  getBuilding();
  $("#txtPNum").attr("min","1");
  $("#txtArea").attr("min","1");
  $('#myModal').modal('show');
});

$("#comBuilding").change(function(data)
{
  console.log("change");
  if($("#btnSave").val()=="Save")
    getFloor();
});


  //display modal form for creating new task



  //create new task / update existing task
  $('#btnSave').on('click',function(e)
  {
    if($("#myForm").parsley().isValid())
    {
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
    $.notify(title, "success");
  }
  function getLatest()
  {
    $.get(url + '/getLatest/' + $("#myId").val(), function (data) 
    {
      console.log(data);
      if(parseInt(data.number) > parseInt(data.ceiling))
      { 
        $.notify("Number of park spaces at maximum!", "error");
        $("#modalParkSpace").modal("hide");
      }
      else if(parseFloat(data.max)<=0)
      { 
        $.notify("Reached maxmimum space.", "error");
        $("#modalParkSpace").modal("hide");
      }
      else
      {
        var max;
        $("#txtPArea").val("");
        $("#txtPPNum").val(parseInt(data.number));
        max=parseFloat(data.max);
        $("#txtPArea").attr("max",max);
      }
    });
  }

  $("#myList").on("click","#btnAddParkSpace",function(e)
  {
    $("#comParkArea").val($(this).val());
    $("#myId").val($(this).val());
    getLatest();
    $.get(url + '/' + $(this).val() + '/edit', function (data) 
    {
      $("#txtBuilDesc").val(data.strBuilDesc);
      $("#txtParkArea").val(data.strParkAreaDesc);
    });
    $("#modalParkSpace").modal("show");
  });

  $('#btnSaveParkSpace').on('click',function(e)
  { 
    if($('#frmParkSpace').parsley().isValid())
    {
      $("#btnSaveParkSpace").attr('disabled','disabled');
      setTimeout(function(){
        $("#btnSaveParkSpace").removeAttr('disabled');
      }, 1000);
      $.ajaxSetup(
      {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })
      e.preventDefault(); 

      var formData = $("#frmParkSpace").serialize();
               //for updating existing resource
               console.log(formData);
               $.ajax({
                type: "POST",
                url: url + "/storeSpace",
                data: formData,
                dataType: 'json',
                success: function (data) {
                  $.notify("The record has been successfully stored.", "success");
                  console.log(data);
                  getLatest();
                },
                error: function (data) {
                  console.log('Error:', data);
                }
              });
             }});
});