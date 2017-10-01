 var contractDetailsTable;
$(document).ready(function()
{ 
   var table = $('#myTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        columns: [
        {data: 'code'},
        {data: 'full_name'},
        {data: 'unit_count'},
        {data: 'date_issued'},
        {data: 'action'},
        ]
    });
   $("#btnShowContractDetails").click(setModal());
});

function setModal(){
    $.ajax({
        url: test,
        type: 'GET',
        dataType: 'json',
        success: function(data) {  
         $.each(data, function(key,value) {
                console.log(value.unit_code);
            });
        },
        error: function(xhr,textStatus,err)
        {
            console.log("readyState: " + xhr.readyState);
            console.log("responseText: "+ xhr.responseText);
            console.log("status: " + xhr.status);
            console.log("text status: " + textStatus);
            console.log("error: " + err);
        }
    })
    .done(function() {
        console.log("success");
    })
    
}

/*
if(contractDetailsTable!=null){
        contractDetailsTable.destroy();
        $('#contractDetailsTable').empty();
    }
    contractDetailsTable= $('#contractDetailsModalTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        columns: [
        {data: 'code'},
        {data: 'full_name'},
        {data: 'unit_count'},
        {data: 'date_issued'},
        {data: 'action'},
        ]
    });
    */