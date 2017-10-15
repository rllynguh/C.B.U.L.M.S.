$(document).ready(function(){
	table = $('#myTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        columns: [
        {data: 'code', name: 'code', title: 'Amendment Code', class: 'align-center'},
        {data: 'name', name: 'name', title: 'Tenant Name', class: 'align-center'},
        {data: 'original_units', name: 'original_units', title: '# of units in contract', class: 'align-center'},
        {data: 'num_of_units', name: 'num_of_units', title: '# of units requested', class: 'align-center'},
        {data: 'num_of_forfeit', name: 'num_of_forfeit', title: '# of units forfeited', class: 'align-center'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $(".accordion").accordion({header: 'h3'});
     $("body").on("click", ".btnShowAmendmentModal", setModal);
});

function setModal(){
	var unitsToKeep = "<h4> Units to keep </h4>";
	var unitsToForfeit = "<h4> Units to forfeited </h4>";
	var unitRequests = "";
	var durationChange = "";
	var unitsForfeited = [];
	var contract_id = $(this).attr('data-contractId');
	var amendment_id = $(this).attr('data-id');
	$.ajax({
        url: dataurl + "/forfeit/" + amendment_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
         $.each(data, function(key,value) {
         	unitsForfeited.push(value.unit_id)
            var type = (value.unit_type == 0)?'Raw':'Shell';
            unitsToForfeit+="<h3>"+ value.unit_code +"</h3><div><b>Unit Type:</b>"+ type 
            +"<br><b>Floor #</b>"+value.unit_floorNum+"<br></div>";
            });
         if(unitsForfeited.length>0){
         	$("#sortable2").html(unitsToForfeit);
         }else{
         	$("#sortable2").html("<h4> No units to be forfeited ")
         }
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
    $.ajax({
        url: dataurl + "/units/" + contract_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) { 
         $.each(data, function(key,value) {
         	if(jQuery.inArray(value.unit_id,unitsForfeited)<0){
         		var type = (value.unit_type == 0)?'Raw':'Shell';
	            unitsToKeep+="<h3>"+ value.unit_code +"</h3><div><b>Unit Type:</b>"+ type 
	            +"<br><b>Floor #</b>"+value.unit_floorNum+"<br></div>";
         	}
         	});
            
         $("#sortable1").html(unitsToKeep);
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