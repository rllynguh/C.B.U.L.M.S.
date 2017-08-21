@extends('layout.coreLayout')
@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="header align-center">
			<h2>
			LIST OF BUILDINGS
			</h2>
		</div>
		<div class="body">
			<table class="table table-hover dataTable" id="myTable">
				<thead>
					<tr>
						<th class="align-center">Building Code</th>
						<th class="align-center">Building  Name</th>
						<th class="align-center">Number of Floors</th>
						<th class="align-center">Location</th>
						<th class="align-center">Status</th>
						<th class="align-center">Action</th>
					</tr>
				</thead>
				<tbody id="myList">
				@foreach($buildings as $build)
				<tr>
				<td>{{ $build->code }}</td>
				<td>{{ $build->num_of_floor }}</td>
				<td>{{ $build->description }}</td>
				<td>{{ $build->location }}</td>
				<td> 
		
				</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection