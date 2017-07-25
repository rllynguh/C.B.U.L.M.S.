
$(document).ready(function()
{
	var table = $('#myTable').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		columns: [
		{data: 'id'},
		{data: 'description'},
		{data: 'size_range'},
		{data: 'unit_type'},
		{data: 'floor'},
		{data: 'unit_select'},
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
				options+="<input class='myRadio' type='radio' name='unit_option' value='"+ value.unit_id +"'><input disabled type='text' value='"+ value.unit_offered +"' id='unit"+ value.unit_id +"'> " + size +"<br>";
			});
			$("#divOptions").append(options);
		});
	});
	$(this).on('click', '.myRadio',function(e)
	{
		value=$(this).val();
		name=$('#unit'+value).val();
		$('#offer'+myId).val(value);
		$('#regi'+myId).val(name);
		console.log(value + " " + 'offer'+myId);
		$("#modalChoose").modal("hide");
	});
	$(document).on('hidden.bs.modal','#modalChoose', function () 
	{ 
		$('#divOptions').empty();
	});
});