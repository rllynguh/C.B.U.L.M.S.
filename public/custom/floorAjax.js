
$(document).ready(function()
{
  //for house keeping
  getBuilding();

  //for datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'description', name: 'description'},
    {data: 'number', name: 'number'},
    {data: 'num_of_unit', name: 'num_of_unit'},
    {data: 'is_active', name: 'is_active', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  //for showing floor add modal
  $('#btnAddModal').on('click',function(e)
  { 
    $('#btnSave').val('Save');
    changeLabel();
    $('#txtUNum').attr('min','1');
    getBuilding();
    $('#myModal').modal('show');
  });

  //for showing floor edit modal
  $('#myList').on('click', '#btnEdit',function()
  { 
    $('#btnSave').val('Edit');
    changeLabel();
    var myId = $(this).val();
    getBuilding();
    $.get(url + '/' + myId + '/edit', function (data) {
      value="";
      if(parseInt(data.current)<1)
        {value="1";
    }
    else
      {value=data.current;}
    var exists = false;
    $('#comBuilding').each(function(){
      if (this.value == data.building_id) {
        exists = true;
        return false;
      }
    });
    if(!exists)
    { 
      $('#comBuilding').append($('<option>', {value: data.building_id, text: data.description}));
      $('#comBuilding').val(data.building_id);
    }
    $("#comBuilding").attr("disabled","");
    $('#myId').val(data.id);
    $('#comBuilding').val(data.building_id);
    $('#txtFNum').val(data.number);
    $('#txtUNum').val(data.num_of_unit);
    $("#txtUNum").attr("min",value);
    $('#myModal').modal('show');
  }) 
  });

  //for storing new record for floor
  $('#btnSave').on('click',function(e)
  { 
    if($("#myForm").parsley().isValid())
    {
      $("#btnSave").attr('disabled','disabled');
      $.ajaxSetup(
      {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })
      e.preventDefault(); 
      var my_url = url;
      var formData = $("#myForm").serialize();
      type="POST";
      if($("#btnSave").val()=="Edit")
        {myId = $('#myId').val();
      type = "PUT";
      my_url += '/' + myId;
    }
    $.ajax({
      type: type,
      url: my_url,
      data: formData,
      success: function (data) {
        table.draw();    
        successPrompt();
        if($("#btnSave").val()=="Save")     
         { getBuilding();      
          $('#txtVUNum').val(""); 
          $("#txtUNum").val("");          
          setTimeout(function(){
            $("#btnSave").removeAttr('disabled');
          }, 2500);   
        }         
        else
          $('#myModal').modal('hide');
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }});

  //for floor softdelete
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

  //for showing unit add modal
  $('#myList').on('click', '#btnAddUnit',function()
  {
    $("#modalUnit").modal("show");
    $("#myId").val($(this).val());
    $("#comFloor").val($(this).val());
    getLatestUnit();
    $.get(url + '/' + $(this).val() + '/edit', function (data) {
      $("#txtFBuilDesc").val(data.description);
      $("#txtUFNum").val(data.number);
    });
  });

  //for storing new record for unit
  $('#btnSaveUnit').on('click',function(e)
  { 
    if($('#frmUnit').parsley().isValid())
    {
      $("#btnSaveUnit").attr('disabled','disabled');
      $.ajaxSetup(
      {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })
      e.preventDefault(); 
      var formData = $("#frmUnit").serialize();
      $.ajax({
        type: "POST",
        url: url + "/storeunit",
        data: formData,
        success: function (data) {
          $.notify("The record has been successfully stored!", "success");
          getLatestUnit();
          $("#txtArea").val("");
          setTimeout(function(){
            $("#btnSaveUnit").removeAttr('disabled');
          }, 1000);
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }});


  function successPrompt(){
    title="Record Successfully Updated!";
    if($("#btnSave").val()=="Save")
      title="Record Successfully Stored!";
    $.notify(title, "success");
  }

  //for quering latest unit number
  function getLatestUnit()
  {
    $.get(urlunit + '/getLatest/' + $("#comFloor").val(),function(data)
    {
      if(parseInt(data.max)<parseInt(data.number))
      {
        $.notify("Number of units at Maximum!", "error");
        $("#modalUnit").modal("hide");
      }
      else
      {
        $("#txtUUNum").val(data.number);
      }
    });
  }

  //for toggling between add and edit
  function changeLabel()
  {
    btn='<span id="lblButton">SAVE CHANGES</span>';
    label=' <h1 id="label" class="modal-title align-center p-b-15">UPDATE FLOOR<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    if($("#btnSave").val()=="Save")
    {
      btn='<span id="lblButton"> SAVE</span>';
      label=' <h1 id="label" class="modal-title align-center p-b-15">NEW FLOOR<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>';
    }    
    $('#lblButton').replaceWith(btn);
    $('#label').replaceWith(label);
  }

  //for querying latest floor Number
  function getLatest()
  {
    if($("#btnSave").val()!="Edit")         
    {
      $.get(url + '/getFloor/' + $("#comBuilding").val(), function (data) 
      {
       $("#txtFNum").val(data.current);
     });
    }
  }

  //for querying list of building
  function getBuilding()
  {
    $.get(url + '/get/building', function (data) {
      selected=$("#comBuilding").val();
      $('#comBuilding').children('option').remove();
      $.each(data,function(index,value)
      {
        $('#comBuilding').append($('<option>', {value:value.id, text:value.description}));
      });
      $("#comBuilding").val(selected);
      if( !$('#comBuilding').has('option').length > 0  && $("#btnSave").val()=="Save" ) 
      { 
        $.notify("No building available", "warn");
        $("#myModal").modal("hide");
      }
      getLatest();
    });
  }

  //for when floor modal gets closed
  $(document).on('hidden.bs.modal','#myModal', function () {
    $("#myForm").trigger('reset');
    $('#myForm').parsley().destroy();
    $("#comBuilding").removeAttr("disabled");
  });

  //for when unit modal gets closed
  $(document).on('hidden.bs.modal','#modalUnit', function () {
    $("#frmUnit").trigger('reset');
    $('#frmUnit').parsley().destroy();
  });

  //for when user selects building
  $("#comBuilding").change(function(data){
    getLatest();
  });


});



