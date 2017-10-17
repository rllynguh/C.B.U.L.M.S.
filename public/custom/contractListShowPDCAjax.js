$(document).ready(function() {
    $.ajaxSetup(
    {
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  });

    table= $("#myTable").DataTable({
        responsive: !0,
        processing: !0,
        serverSide: !0,
        ajax: dataurl,
        columns: [ {
            data: "code"
        }, {
            data: "for_date"
        }, {
            data: "description"
        }, {
            data: "amount"
        }, {
            data: "action"
        } ]
    });

    $(this).on('click', '#btnEditPDC',function()
    { 
        var myId = $(this).val();
        $.get(url + '/' + myId + '/editPDC', function (data) 
        {
          $('#myId').val(data.id);
          $('#bank').val(data.bank_id);
          $('#code').val(data.code);
          $('#amount').val(data.amount);
          $('#for_date').val(data.for_date);
          $('#myModal').modal('show');
      }) 
    });

    $('#btnSave').on('click',function(e)
    {
        myId=$('#myId').val();
        formData=$('#myForm').serialize();
        if($('#myForm').parsley().isValid())
        {
            e.preventDefault();
            $.ajax({
                type: "PUT",
                url: url +"/" + myId +"/updatePDC",
                data: formData,
                success: function (data) {
                  table.draw();  
                  successPrompt(); 
                  $('#myModal').modal('hide');
              },
              error: function (data) {
                  console.log('Error:', data.responseText);
              }
          });
        }}
        );

    //for prompting a message to the user
    function successPrompt(){
        title="PDC Successfully Updated!";
        $.notify(title, "success",
        {
            timer:1000
        });
    }
});