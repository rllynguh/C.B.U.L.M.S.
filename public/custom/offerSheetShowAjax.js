
$(document).ready(function()
{
	$.ajaxSetup(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	var table = $('#myTable').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: {
			url: dataurl,
			type: "POST"
		},
		columns: [
		{data: 'id'},
		{data: 'description'},
		{data: 'size_range'},
		{data: 'unit_type'},
		{data: 'floor'},
		{data: 'unit_select'},
		{data: 'rate'},
		{data: 'choose'}
		]
	}); 
	myId="";
	$(this).on('click', '#btnChoose',function(e)
	{
		myId=$(this).val();
		$.get(url + '/showOptions/' + myId, function (data) 
		{
			console.log(data);
			options="";
			$("#modalChoose").modal("show");
			$.each( data, function( index, value ){
				mode='warning';
				if(value.offered_exact_size>=value.size_from && value.offered_exact_size<=value.size_to)
					mode='success';
				size="Size : <small class='label label-" + mode + "'>"+ value.offered_exact_size +" sqm</small>";
				rate="Prize: <small class='label label-success'>"+ value.rate +"</small>";
				options+="<input type='radio' id='"+ value.unit_offered +"' class='myRadio' class='radio-col-yellow type='radio' name='unit_option' value='"+ value.unit_id +"'><label for='"+ value.unit_offered +"' id='unit"+ value.unit_id +"'>" + value.unit_offered+ "</label> " + size + rate + "<br>";
			});
			$("#divOptions").append(options);
		});
	});
	$(this).on('click', '.myRadio',function(e)
	{
		value=$(this).val();
		name=$('#unit'+value).text();
		$('#offer'+myId).val(value);
		$('#regi'+myId).text(name);
		console.log(value + " " + 'offer'+myId);
		$("#modalChoose").modal("hide");
	});
	$(document).on('hidden.bs.modal','#modalChoose', function () 
	{ 
		$('#divOptions').empty();
	});
});