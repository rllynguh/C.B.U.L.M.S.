
$(document).ready(function()
{
	$.ajaxSetup(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	myId="";
	value="";
	$(this).on('click', '#btnChoose',function(e)
	{
		myId=$(this).val();
		$.get(url + '/showOptions/' + myId, function (data) 
		{
			options="";
			$("#modalChoose").modal("show");
			ctr=0;
			$.each( data, function( index, value ){
				main_mode='light-green';
				if((!(value.size>=value.size_from && value.size<=value.size_to))||
					(value.offered_building_type!=value.ordered_building_type) ||
					(value.offered_floor!=value.ordered_floor) ||
					(value.offered_unit_type!=value.ordered_unit_type)
					)
					main_mode='orange';
				if(ctr%2==0)
					options+='<div>'
				checked='';
				if(ctr==0)
					checked='checked';
				building_type="<span class='align-right' id='myBuildingType"+ value.unit_id  + "'>"+ value.offered_building_type +" </span>";
				floor="<span class='align-right' id='myFloor"+ value.unit_id +"'>"+ value.offered_floor +" </span>";
				size="<span class='align-right' id='mySize"+ value.unit_id +"'>"+ value.offered_exact_size +" </span>";
				unit_type="<span class='align-right' id='myUnitType"+ value.unit_id +"'>"+ value.offered_unit_type +" </span>";
				rate="<span class='align-right' id='myRate"+ value.unit_id +"'>"+ value.rate +"</span>";
				building="<span class='align-right'>"+ value.building +"</span>";
				address="<span class='align-right'>"+ value.address +"</span>";

				options+=
				'<div class="col-sm-6">' +
				'<div class="card">' +
				'<div class="header bg-'+main_mode+'">' +
				"<input type='radio'" + checked + " id='"+ value.unit_offered +"' class='myRadio' class='radio-col-yellow type='radio' name='unit_option' value='"+ value.unit_id +"'>" +
				"<label for='"+ value.unit_offered +"' id='unit"+ value.unit_id +"'>" + value.unit_offered+ "</label> <br>" +
				'</div>' +
				'<div class="body">' +
				'<div id="labels" class="col-sm-6">' +
				'<b>Building Type: </b><br>' +
				'<b>Building Name: </b><br>' +
				'<b>Address: </b><br>' +
				'<b>Unit Type : </b><br>' +
				'<b>Floor : </b><br>' +
				'<b>Size : </b><br>' +
				'<b>Price: </b><br>' +
				'</div>' +
				'<div id="details" class="align-right" >' +
				building_type + " <br>" +
				building + " <br>" +
				address + " <br>" +
				unit_type + " <br>" +
				floor + " <br>" +
				size + " <br>" +
				rate + " <br>" +
				'</div>'+
				'</div>'+
				'</div>' +
				'</div>';
				if(ctr%2!=0)
					options+='</div>';
				ctr++;
			});
			$("#divOptions").append(options);
			value=$('.myRadio').val();
		});
	});
	$(this).on('click', '.myRadio',function(e)
	{
		value=$(this).val();
	});
	$(this).on('click', '#btnSelect',function(e)
	{
		if($('.myRadio').is(':checked')) { 
			name=$('#unit'+value).text();
			$('#offer'+myId).val(value);
			$('#regi'+myId).text(name);
			$('#rate'+myId).text($('#myRate'+value).text());
			$('#buildingType'+myId).text($('#myBuildingType'+value).text());
			$('#unitType'+myId).text($('#myUnitType'+value).text());
			$("#modalChoose").modal("hide");
		}
		else
			$.notify("Please select a unit.", "error");
	});
	$(document).on('hidden.bs.modal','#modalChoose', function () 
	{ 
		$('#divOptions').empty();
	});
});