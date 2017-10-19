var id;
$(document).ready(function(){
	var table = $('#myTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: urldata,
        columns: [
        {data: 'code',name: 'code', title: 'Contract Code', class: 'align-center'},
        {data: 'time_end',name: 'time_end', title: 'Ends on', class: 'align-center'},
        {data: 'type',name: 'code', title: 'Type', class: 'align-center'},
        {data: 'duration',name: 'duration', title: 'Amount Desired', class: 'align-center'},
        {data: 'action', name: 'action', orderable: false, searchable: false, class :'align-center'},
        ]
    });
    $("body").on("click", ".btnApproval", function(){
    	id = $(this).attr('data-id');
    });
    $("body").on("click", ".btnAction", setApproval);
});
function setApproval(){
	var type = ($(this).attr('id')==='btnAccept')?'accept':'deny';
	if (confirm("Are you sure you wish to "+ type + " this request?") == true){
	    $.ajax({
	    	url: urlpost,
	    	type: 'POST',
	    	data: {action:type,id:id},
	    	success: function(data){
	    		console.log(data);
	    	},
	    	error: function(xhr,textStatus,err){
	            console.log("readyState: " + xhr.readyState);
	            console.log("responseText: "+ xhr.responseText);
	            console.log("status: " + xhr.status);
	            console.log("text status: " + textStatus);
	            console.log("error: " + err);
	        }
	    });
	    
	}
	
}