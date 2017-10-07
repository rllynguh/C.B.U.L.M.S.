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
  
   //$("#tabs").tabs();
   $("body").on("click", ".btnShowContractDetails", setModal);
});

function setModal(){
    var header = "";
    var details = "";
    var list = "<ul>";
    var content = "";
    var total_cost = "$";
    var id = $(this).attr('data-id');
    $.ajax({
        url: urlUnits,
        type: 'GET',
        dataType: 'json',
        success: function(data) {  
         $.each(data, function(key,value) {
            list +=  "<li><a href='#tabs-" + (key+1) + "'>"+ value.unit_code + "</a></li>";
            content+="<div id = 'tabs-"+(key+1)+"'><div><b>Unit Type:</b>"+ value.unit_type 
            +"<br><b>Floor #</b>"+value.unit_floorNum+"<br></div></div>";
            if((key+1)==id){
                header += "<p id = 'test'>" + value.contract_code +"</p>";
                details += "<br><b>Date Issued: </b>" + value.date_issued;
                details += "<br><b>Start of Contract: </b>" + value.start_date;
                details += "<br><b>End of Contract: </b>" + value.end_date;
                details += "<br><b>Approved by: </b>" + value.name;
                total_cost += value.total_cost;
            }else{
                console.log("key:"+key);
                console.log("id:"+id);
            }
            });
         list += "</ul>";
         $("#header").html(header);
         $("#total_cost").html(total_cost);
         $("#contractDetailsTable").html(details);
         $("#tabs").html(list+content);
         $("#tabs").tabs();
         $('#test').editable({
            type: 'text',
            title: 'Enter username',
            success: function(response, newValue) {
               // userModel.set('username', newValue); //update backbone model
            }
        });
         //console.log(list);
         //console.log(content);
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