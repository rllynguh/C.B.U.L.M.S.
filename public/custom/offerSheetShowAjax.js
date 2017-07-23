
$(document).ready(function()
{ 
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
				if(value.offered_exact_size>=value.size_from && value.offered_exact_size<=value.size_to)
					mode='success';
				else
					mode='warning';
				size="Size : <small class='label label-" + mode + "'>"+ value.offered_exact_size +" sqm</small>";

				options+="<input type='radio' name='unit_option' value='"+ value.unit_id +"'><input disabled type='text' value='"+ value.unit_offered +"' id='unit"+ value.unit_id +"'> " + size +"<br>";
			});
			$("#divOptions").append(options);
		});
	});
	$(this).on('click', '#btnSelect',function(e)
	{
		value=$("input[name='unit_option']:checked").val();
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