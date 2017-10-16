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
        {data: 'action', name: 'action', title:'Actions' ,orderable: false, searchable: false}
        ]
    });
})