var action = 0;
var contract_id=0;
var amendment_id=0;
$(document).ready(function(){
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
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
     $("body").on("click","#btnSubmit", setApproval);
     $('#confirm-dialog').on('show.bs.modal', function (event) {
     	if(event.relatedTarget.id==='btnAccept'){
     		action = 1;
     	}else{
     		action = 2;
     	}
	});
});

function setApproval(){
	var data = [];
	if(action==1||action==2){
		data.push({name:"id",value:amendment_id});
		data.push({name:"status",value:action});
		data.push({name:"admin_remarks",value:$('#tenantRemark').val() });
		console.log(data);
		$.ajax({
	        url: url + "/post/",
	        type: 'POST',
	        data: $.param(data),
	        success: function(data) {
	         //$(".accordion").accordion("refresh");
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
	action=0;
	location.reload();
	//console.log(action);	
}

function setModal(){
	var unitsToKeep = "<h4> Units to keep </h4>";
	var unitsToForfeit = "<h4> Units to forfeited </h4>";
	var unitRequests = "<h4> Units Requested </h4>";
	var durationChange = $(this).attr('data-duration');;
	var unitsForfeited = [];
	contract_id = $(this).attr('data-contractId');
	amendment_id = $(this).attr('data-id');
	if(durationChange!=0){
		var sign = durationChange>0?"Add ":"Less ";
		$("#duration").html("Duration change: " + sign + Math.abs(durationChange) + " months ");
	}else{
		$("#duration").html("No change in duration");
	}
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
         //$(".accordion").accordion("refresh");
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
        // $(".accordion").accordion("refresh");
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
        url: dataurl + "/request/" + amendment_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) { 
         $.each(data, function(key,value) {
     		var type = (value.unit_type == 0)?'Raw':'Shell';
            unitRequests += "<div class = 'requestStub'> <h3>Unit Request" + (key+1)
	        + "</h3><div><b>Unit Type: </b> " + type
	        +"<br><b>Building Type:</b>" +value.building_description
	        +"<br><b>Floor #</b>" + value.floor_num
	        +"<br><b>Size: </b>" + value.size
	        +"<br><b>Remarks:</b>" + value.remarks
	        +"</div></div>";
     	});
        
         $("#requests").html(unitRequests);
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