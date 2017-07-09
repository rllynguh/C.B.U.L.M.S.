@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">{{$tenant->description}}</h2>
		</div>
		
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header align-center">
					<h2>
						Unit Offers for {{$tenant->description}}
					</h2>
				</div>
				<div class="body">
					<table class="table table-hover dataTable" id="myTable">
						<thead>
							<tr>
								<th class="align-center">Registration Detail</th>
								<th class="align-center">Unit Offer</th>
							{{-- 	<th class="align-center">Building Type</th>
								<th class="align-center">Unit Type</th>
								<th class="align-center">Floor</th>
								<th class="align-center">Size</th> --}}

							</tr>
						</thead>
						<tbody id="myList">
							@foreach($result as $result)
							<tr>
								<td>
									{{$result->regi}}
								</td>
								<td>
									@if(is_null($result->unit_code))
									No unit available
									@else
									{{$result->unit_code}}
									@endif
									<input type="hidden" name="regi_detail[]" value="{{$result->regi}}">
									<input type="hidden" name="unit_id[]" value="{{$result->unit_id}}">
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection
{{-- SELECT
registration_details.id as regi,
units.id as unit,
floors.number as floor,
buildings.id as building,
registration_details.unit_type as ordered_unit_type,
units.type as proposed_unit_type,
registration_details.size as ordered_size,
units.size as proposed_size,
registration_details.floor as ordered_floor,
floors.number as proposed_floor,
registration_details.building_type_id as ordered_building_type,
buildings.building_type_id as porposed_building_type 
from registration_details
inner join registration_headers on registration_details.registration_header_id=registration_headers.id
left join units on registration_details.unit_type=units.type AND (registration_details.size between units.size - 100 AND units.size + 100)
left join floors on units.floor_id=floors.id AND registration_details.floor=floors.number
left join buildings on floors.building_id=buildings.id AND registration_details.building_type_id=buildings.building_type_id
where  registration_headers.id=2
group by registration_details.id

 --}}