$(document).ready(function()
{
  $.ajaxSetup(
  {
    headers: 
    {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });
  //for house keeping
  getBuilding();

  //for datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'building_description', name: 'building_description'},
    {data: 'description', name: 'description'},
    {data: 'number', name: 'number'},
    {data: 'size', name: 'size'},
    {data: 'num_of_space', name: 'num_of_space'},
    {data: 'is_active', name: 'is_active', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  //for showing park area edit modal 
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
    value=data.space_size;
    if(parseInt(data.space_size)<=1)
      value=1;
    $("#txtArea").attr("min",value);
    
    var exists = false;
    $('#comBuilding').each(function()
    {
      if (this.value == data.building_id) {
        exists = true;
        return false;
      }});
    if(!exists)
    {
      $('#comBuilding').append($('<option>', {value: data.building_id, text: data.building_description}));
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
    $('#txtPNum').val(data.num_of_space);
    $('#txtArea').val(data.size);
  }); 
    $('#myModal').modal('show');
  });

  //for showing park area add modal
  $('#btnAddModal').on('click',function(e)
  { 
    $('#btnSave').val('Save');
    changeLabel();
    getBuilding();
    $("#txtPNum").attr("min","1");
    $("#txtArea").attr("min","1");
    $('#myModal').modal('show');
  });

  //for saving or updating park area record
  $('#btnSave').on('click',function(e)
  {
    if($("#myForm").parsley().isValid())
    {
      myId=$("#myId").val();
      my_url=url;
      e.preventDefault(); 
      var formData = $("#myForm").serialize();
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
      success: function (data) 
      {
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

    //for soft deleting park area
    $('#myList').on('change', '#IsActive',function(e)
    { 
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

  //for showing park space add modal 
  $("#myList").on("click","#btnAddParkSpace",function(e)
  {
    $("#comParkArea").val($(this).val());
    $("#myId").val($(this).val());
    getLatest();
    $.get(url + '/' + $(this).val() + '/edit', function (data) 
    {
      $("#txtBuilDesc").val(data.building_description);
      $("#txtParkArea").val(data.description);
    });
    $("#modalParkSpace").modal("show");
  });

  //for saving park space record
  $('#btnSaveParkSpace').on('click',function(e)
  { 
    if($('#frmParkSpace').parsley().isValid())
    {
      $("#btnSaveParkSpace").attr('disabled','disabled');
      setTimeout(function(){
        $("#btnSaveParkSpace").removeAttr('disabled');
      }, 1000);
      e.preventDefault(); 

      var formData = $("#frmParkSpace").serialize();
               //for updating existing resource
               $.ajax({
                type: "POST",
                url: url + "/storeSpace",
                data: formData,
                success: function (data) {
                  $.notify("The record has been successfully stored.", "success");
                  getLatest();
                },
                error: function (data) {
                  console.log('Error:', data);
                }
              });
             }});

  //for when parkArea modal gets closed
  $(document).on('hidden.bs.modal','#myModal', function () 
  {
    $("#myForm").trigger('reset');
    $('#myForm').parsley().destroy();
    $("#comBuilding").removeAttr("disabled");
    $("#comFloor").removeAttr("disabled");
  });

  //for when parkSpace modal gets closed
  $(document).on('hidden.bs.modal','#modalParkSpace', function () 
  {
    $("#frmParkSpace").trigger('reset');
    $('#frmParkSpace').parsley().destroy();
  });

  //for when a user changes selected building
  $("#comBuilding").change(function(data)
  {
    if($("#btnSave").val()=="Save")
      getFloor();
  });

 //for prompting user
 function successPrompt(){
  title="Record Successfully Updated!";
  $.notify(title, "success");
}


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

   // for querying latest park space number
   function getLatest()
   {
    $.get(url + '/getLatest/' + $("#myId").val(), function (data) 
    {
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

  //for querying list of buildings 
  function getBuilding()
  {
    $.get(url + '/get/building', function (data) 
    {
      selected=$("#comBuilding").val();
      $('#comBuilding').children('option').remove();
      $.each(data,function(index,value)
      {
        $('#comBuilding').append($('<option>', {value:value.id, text:value.description}));
      });
      $("#comBuilding").val(selected);
      if( !$('#comBuilding').has('option').length > 0  && $("#btnSave").val()=="Save" ) 
      { 
        $.notify("No building available.", "warning");
        $("#myModal").modal("hide");
      }
      getFloor();
    });
  }

  //for querying list of floors available
  function getFloor()
  {
    $.get(url + '/getFloor/' + $("#comBuilding").val(), function (data) 
    {
     selected=$("#comFloor").val();
     $('#comFloor').children('option').remove();
     $.each(data,function(index,value)
     {
      $('#comFloor').append($('<option>', {value:value.id, text:value.number}));
    });
     $("#comFloor").val(selected);
   });

    //for toggle between save and edit
  }
});