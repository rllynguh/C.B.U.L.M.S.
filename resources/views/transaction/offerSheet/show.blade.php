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
		<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-col-green">
					{{ Form::open([
						'id' => 'myForm', 'class' => 'form-horizontal'
						])
					}}
					<div class="modal-header">
						<h1 id="label" class="modal-title align-center p-b-15">Choose from these units<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
					</div>
					<div class="modal-body">
						<div id='divOptions'>

						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> SAVE</span></button>
						<input type="hidden" id="myId" value="0">
					</div>
					{{Form::close()}}
				</div>

			</div>
		</div>
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
								<th class="align-center">Preferred Building Type</th>
								<th class="align-center">Preferred Unit Size Range</th>
								<th class="align-center">Preferred Unit Type</th>
								<th class="align-center">Preferred Floor</th>
								<th class="align-center">Unit Offer</th>
								<th class="align-center">Action</th>

							</tr>
						</thead>
						<tbody id="myList">
							@foreach($result as $result)
							<tr>
								<td>
									{{$result->id}}
								</td>
								<td>
									{{$result->description}}
								</td>
								<td>
									{{$result->size_range}}
								</td>
								<td>
									@if($result->unit_type==0)
									Raw
									@else
									Shell
									@endif
								</td>
								<td>
									{{$result->floor}}
								</td>
								<td>
									- - -
								</td>
								<td>
									<button id="btnChoose" type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" value="{{$result->id}}"><i class="mdi-content-add"></i></button>
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
{!!Html::script("custom/offerSheetShowAjax.js")!!}
<script type="text/javascript">
</script>
@endsection
{{-- select registration_details.id as order_number, offered_unit.code as unit_offered,  registration_details.unit_type as ordered_unit, offered_unit.type as offered_unit, 
CONCAT(registration_details.size_from,'-',registration_details.size_to) as ordered_range,
offered_unit.size as offered_exact_size,
ordered_building_type.description as ordered_building_type,
offered_building_type.description as offered_building_type,
registration_details.floor as ordered_floor,
offered_floor.number as offered_floor
 from registration_details
left join registration_headers on registration_details.registration_header_id=registration_headers.id
left join building_types as ordered_building_type on registration_details.building_type_id=ordered_building_type.id
left join units as offered_unit on registration_details.unit_type=offered_unit.type and offered_unit.size between registration_details.size_from and registration_details.size_to
left join floors as ordered_floor on registration_details.floor=ordered_floor.number
inner join floors as offered_floor on offered_unit.floor_id=offered_floor.id
inner join buildings as offered_building on offered_floor.building_id=offered_building.id
inner join building_types as offered_building_type on offered_building.building_type_id=offered_building_type.id
group by registration_details.id
order by registration_details.id --}}
