$(document).ready(function()
{ 
  xhrPool=[];
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'code'},
    {data: 'tenant'},
    {data: 'business'},
    {data: 'unit_count'},
    {data: 'action'}
    ]
  });


  myId="";
  $(this).on('click', '#btnAddRequirement',function(e)
  {
    // $(this).attr('disabled','');
    // setTimeout(function(){
    //   $(".btn").removeAttr('disabled');
    // }, 500);   
    $("#btnSaveReq").val('add');
    $('#labelReq').text('ADD REQUIREMENT/S');
    $('#buttonReq').text(' ADD');
    myId=$(this).val();
    $("#idReg").val(myId);
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
    // $(this).attr('disabled','');
    // setTimeout(function(){
    //   $("#btnEditRequirement").removeAttr('disabled');
    // }, 1000);   
    $("#btnSaveReq").val('edit');
    $('#labelReq').text('EDIT REQUIREMENT/S');
    $('#buttonReq').text(' SAVE CHANGES');
    myId=$(this).val();
    $("#idReg").val(myId);
    req="";
    $.get(url + '/showCurrentRequirements/' + myId, function (data) 
    {
      console.log(data);
      if(Object.keys(data).length>0)
      {
        $("#modalRequirement").modal("show");
        $.each( data, function( index, value ){
          if(value.busi_type_id==null)
            mode=" ";
          else
            mode="disabled ";
          req+="<input id='checkboxReq' name='checkboxReq[]' " + mode + " value='" +  
          value.id +"' type='checkbox' checked>" + value.description + "<br>";
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
        console.log(data);
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

  function successPrompt(){
    title="Requirement Successfully Updated!";
    if($("#btnSaveReq").val()=="Save")
      title="Requirement Successfully Added!";
    $.notify(title, "success");
  }
});