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
    $("body").on("click", ".btnApproval", setApproval);
});
function setApproval(){
	
}