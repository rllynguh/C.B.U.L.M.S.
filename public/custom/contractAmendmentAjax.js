 var contractDetailsTable;
 var duration = $("#duration");
 const MAX_CHANGE = 12;
 var contract_id = 0;
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
   $(".accordion").accordion({header: 'h3'});
   $("body").on("click", ".btnShowContractDetails", setModal);
   $("body").on("click", ".btnAlterContract", showEditModal);
   $("#btnAmendmentSubmit").click(function(e){
    e.preventDefault();
    submitRequest();
   })
   $( "#sortable1, #sortable2" ).sortable({
      connectWith: "#sortable1, #sortable2",
      items: '.s_panel',
      placeholder: "ui-state-highlight"
    });

    $( "#sortable1, #sortable2, #requests" ).disableSelection();
    duration.spinner();
    duration.spinner({
      spin: function( event, ui ) {
        if ( ui.value > MAX_CHANGE ) {
          duration.spinner( "value", -MAX_CHANGE );
          return false;
        } else if ( ui.value < -MAX_CHANGE ) {
          duration.spinner( "value", MAX_CHANGE );
          return false;
        }
      }
    });
    duration.spinner("disable");
    $("#durationToggle").change(function(){
        duration.spinner("value",1);
        if(this.checked){
            duration.spinner("enable");
        }else{
            duration.spinner("disable");
        }
    });
});
function submitRequest(){
    var data = $("#testform").serializeArray();
    data.push({name:"contract_id",value:contract_id});
    $("#sortable2").find(".s_panel").each(function(index,value){
        data.push({name:"discard_code[]", value: $(this).data("code")});
    });  
    if($("#durationToggle").is(':checked')){
        data.push({name:"duration_change",value: duration.spinner("value")})   
    }
   //console.log(data);
   //console.log($.param(data));
    $.ajax({
        url: urlStore,
        type: 'POST',
        data: $.param(data),
        success: function(data) {
            alert(data.status+"\n"+data.message);
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
function addUnitRequest(){
    var data = $("#testform").serializeArray();
    var requests = "<h4> Units to be requested </h4>";
    // splits the form data into the individual requests
    var i,j,temparray,chunk = 5;
    for (i=0,j=data.length; i<j; i+=chunk) {
        temparray = data.slice(i,i+chunk);
        //console.log(temparray);
        var num = ((i+chunk)/5);
        var type = (temparray[2].value == 0)?'Raw':'Shell';
        requests += "<div class = 'requestStub'> <h3>Unit Request" + num
        + "</h3><div><b>Unit Type: </b> " + type
        +"<br><b>Building Type:</b>" +building_types[temparray[0].value]
        +"<br><b>Floor #</b>" + temparray[1].value
        +"<br><b>Size: </b>" + temparray[3].value
        +"<br><b>Remarks:</b>" + temparray[4].value
        +"</div></div>";
    }
    $("#requests").html(requests);
    $(".accordion").accordion("refresh");
    $("#createRequestModal").modal('hide');
}
function showEditModal(){
    $('.accordion').accordion({
        collapsible: true,
        active: false,
        header: 'h3',
        icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }
    }).sortable({
        items: '.s_panel',
        placeholder: "ui-state-highlight"
    });
    contract_id = $(this).attr('data-id');
    var content = "<h4> Units to be kept </h4>";
    $.ajax({
        url: urlUnits + "/" + contract_id,
        type: 'GET',
        dataType: 'json',
        data: contract_id,
        success: function(data) {  
         $.each(data, function(key,value) {
            var type = (value.unit_type == 0)?'Raw':'Shell';
            content+="<div class = 's_panel' data-code = "+value.unit_id+">"
            +"<h3>"+ value.unit_code +"</h3>"
            +"<div><b>Unit Type:</b> "+ type
            +"<br><b>Floor #</b>"
            +value.unit_floorNum+"</div></div>";
            });
         $("#sortable1").html(content);
         $(".accordion").accordion("refresh");
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

function setModal(){
    var header = "";
    var details = "";
    var content = "";
    var total_cost = "$";
    contract_id = $(this).attr('data-id');
    var num = 1;
    $.ajax({
        url: urlUnits + "/" + contract_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {  
         $.each(data, function(key,value) {
            var type = (value.unit_type == 0)?'Raw':'Shell';
            content+="<h3>"+ value.unit_code +"</h3><div><b>Unit Type:</b>"+ type 
            +"<br><b>Floor #</b>"+value.unit_floorNum+"<br></div>";
            if(key==0){
                header += value.contract_code;
                details += "<br><b>Date Issued: </b>" + value.date_issued;
                details += "<br><b>Start of Contract: </b>" + value.start_date;
                details += "<br><b>End of Contract: </b>" + value.end_date;
                details += "<br><b>Approved by: </b>" + value.name;
                total_cost += value.total_cost;
            }
            });
         $("#header").html(header);
         $("#total_cost").html(total_cost);
         $("#contractDetailsTable").html(details);
         $("#unitsDetail").html(content);
         $(".accordion").accordion("refresh");
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