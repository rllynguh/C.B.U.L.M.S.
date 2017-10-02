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
   $.fn.editable.defaults.mode = 'inline';
   $('#test').editable({
    type: 'text',
    title: 'Enter username',
    success: function(response, newValue) {
        userModel.set('username', newValue); //update backbone model
    }
});
   //$("#tabs").tabs();
   $("#btnShowContractDetails").click(setModal());
});

function setModal(){
    var list = "<ul>";
    var content = "";
    var i = 1;
    $.ajax({
        url: urlUnits,
        type: 'GET',
        dataType: 'json',
        success: function(data) {  
         $.each(data, function(key,value) {
            list +=  "<li><a href='#tabs-" + (key+1) + "'>"+ value.unit_code + "</a></li>";
            content+="<div id = 'tabs-"+(key+1)+"'><div><b>Unit Type:</b>"+ value.unit_type 
            +"<br><b>Floor #</b>"+value.unit_floorNum+"<br></div></div>";
                //console.log(value.unit_code);
                console.log(key);
            });
         list += "</ul>";
         $("#tabs").html(list+content);
         $("#tabs").tabs();
         console.log(list);
         console.log(content);
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