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
});