
$(document).ready(function()
{ 
  //for datatables
  var table = $('#myTable').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    columns: [
    {data: 'description', name: 'description'},
    {data: 'date_as_of', name: 'date_as_of'},
    {data: 'rate', name: 'rate'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  //for showing edit modal
  $('#myList').on('click', '.open-modal',function()
  { 
    var myId = $(this).val();
    $.get(url + '/' + myId + '/edit', function (data) 
    {
      $('#lblHeader').replaceWith("<p id='lblHeader'>Update</p>");
      $('#myId').val(myId);
      $('#txtRate').val(data.rate);
      $('#myModal').modal('show');
      $('#btnSave').val('Save');
    }) 
  });

  //for updating data
  $('#btnSave').on('click',function(e)
  {
    if($('#myForm').parsley().isValid())
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
      myId=$('#myId').val();
      var formData = $('#myForm').serialize();
      $.ajax({
        type: type,
        url: my_url,
        data: formData,
        success: function (data) {
          rate=data.rate;
          date=data.date_as_of;
          if(parseInt(data.rate)==0)
          {
            rate="not set";
            date="n/a"
          }
          table.draw();
          successPrompt();
          $('#myModal').modal('hide');
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }}
    );

  //for prompting user
  function successPrompt(){
    title="Record Successfully Updated!";
    $.notify(title, "success");
  }

  //for when edit modal gets closed
  $(document).on('hidden.bs.modal','#myModal', function () 
  { 
    $('#myForm').parsley().destroy();
    $("#myForm").trigger("reset");
  });

}
);



