
$(document).ready(function()
{
	$.ajaxSetup(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	myId="";
	$(this).on('click', '#btnChoose',function(e)
	{
		myId=$(this).val();
		$.get(url + '/showOptions/' + myId, function (data) 
		{
			console.log(data);
			options="";
			$("#modalChoose").modal("show");
			ctr=0;
			$.each( data, function( index, value ){
				if(ctr%3==0)
					options+='<div>'
				mode='warning';
				if(value.size>=value.size_from && value.size<=value.size_to)
					mode='success';
				building_type_mode='warning';
				if(value.offered_building_type==value.ordered_building_type)
					building_type_mode='success';
				floor_mode='warning';
				if(value.offered_floor==value.ordered_floor)
					floor_mode='success';
				unit_type_mode='warning';
				if(value.offered_building_type==value.ordered_building_type)
					unit_type_mode='success';
				building_type="<b>Building Type : </b><small id='myBuildingType"+ value.unit_id +"' class='label label-" + building_type_mode + "'>"+ value.offered_building_type +" </small>";
				floor="<b>Floor : </b><small id='myFloor"+ value.unit_id +"' class='label label-" + floor_mode + "'>"+ value.offered_floor +" </small>";
				size="<b>Size : </b><small id='mySize"+ value.unit_id +"' class='label label-" + mode + "'>"+ value.offered_exact_size +" </small>";
				unit_type="<b>Unit Type : </b><small id='myUnitType"+ value.unit_id +"' class='label label-" + unit_type_mode + "'>"+ value.offered_unit_type +" </small>";
				rate="<b>Price: </b><small id='myRate"+ value.unit_id +"' class='label label-success'>"+ value.rate +"</small>";
				options+=
				'<div class="thumbnail col-sm-4">' +
				'<div class="caption">' +
				"<input type='radio' id='"+ value.unit_offered +"' class='myRadio' class='radio-col-yellow type='radio' name='unit_option' value='"+ value.unit_id +"'>" +
				"<label for='"+ value.unit_offered +"' id='unit"+ value.unit_id +"'>" + value.unit_offered+ "</label> <br>" +
				building_type + " <br>" +
				unit_type + " <br>" +
				floor + " <br>" +
				size + " <br>" +
				rate + " <br>" +
				'</div>'+
				'</div>';
				if(ctr%3!=0)
					options+='</div>';
				ctr++;
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
		$('#rate'+myId).text($('#myRate'+value).text());
		$('#buildingType'+myId).text($('#myBuildingType'+value).text());
		$('#unitType'+myId).text($('#myUnitType'+value).text());
		$("#modalChoose").modal("hide");
	});
	$(document).on('hidden.bs.modal','#modalChoose', function () 
	{ 
		$('#divOptions').empty();
	});
});