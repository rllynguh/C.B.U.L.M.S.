var penalties = [];
var total=0;
var security_deposit = 0;
$(document).ready(function(){ 
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	var table = $('#myTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        columns: [
        {data: 'code', name: 'code', title: 'Contract Code Code', class: 'align-center'},
        {data: 'full_name', name: 'full_name', title: 'Tenant Name', class: 'align-center'},
        {data: 'unit_count', name: 'unit_count', title: '# of units in contract', class: 'align-center'},
        {data: 'security_deposit', name: 'security_deposit', title: 'Security Deposit', class: 'align-center'},
        {data: 'action', name: 'action', title:'Actions' ,orderable: false, searchable: false}
        ]
    });
    $("body").on("click",".btnShowTerminateModal",function(){
    	$("#security_deposit").html($(this).attr('data-security'));
    	security_deposit = $(this).attr('data-security');
    })
    $("body").on("click","#btnTerminateContract",terminateContract);
    $("body").on("click", "#add-row", function(){
    	if(($("#name").val())&&($("#value").val()>0)){
    		var name = $("#name").val();
	        var value = $("#value").val();
	        var markup = "<tr class = 'item'><td class = 'name'>" + name + "</td><td class = 'value'>" + value + "</td><td class = 'danger'><button class='btn btn-danger delete-row'>Remove</button></td></tr>";
	        $("#tablePenalties").append(markup);
	        recalculate();
    	}else{
    		alert('Please enter a name and non-zero value');
    	}
    	
    });
    $("body").on("click", ".delete-row", function(){
    	console.log('tatat');
        $(this).closest('tr').remove();
        recalculate();
    });
})
function terminateContract(){
	var r = confirm("Are you sure you want to terminate this contract? This is irreversible. Overdue penalties will be deducted from the tenant's balance");
	if (r == true) {
		penalties.push({name:"Total",value:total});
		console.log(penalties);
	} else {
	}
}
function recalculate(){
	penalties = [];
	total = 0;
	$("tr.item").each(function(index,value) {
		penalties.push({name:$(this).find("td.name").html()+"["+(index+1)+"]",value:$(this).find("td.value").html()});
		total+= +($(this).find("td.value").html());
	});
	$("#total").html(total);
	$("#remaining").html(security_deposit-total);
}