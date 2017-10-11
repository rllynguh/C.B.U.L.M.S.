<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Student Grade Report</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
	}
	table, th, td {
		border: 1px solid black;
		padding: 5px;
	}
	tr:nth-child(even) {background-color: #f2f2f2}
	th {
		background-color: #DD4B39;
		color: white;
	}
	img {
		height: 20px;
		width: 20px;
	}
	.col {
		width: 30px;
	}
</style>
</head>
<body>
	<center><b>MAJENT<br>
		<small>TAGUIG CITY<br>
			Lessor<br>
		</small>
		<big>
			<i>{{Auth::user()->first_name }} {{Auth::user()->last_name }}</i><br>
		</big></center><br><br>
		<hr>
		<hr><br>
		<b><br></b><br>
		Scholarship ID: <b></b><br>
		Name: <b></b><br>
		School: <b></b><br>
		Course: <b></b><br><br>
		<big><center><b>List of Move In's per Tenant</b></center></big><br>
		@foreach($categories as $category)
		<center><h1>
			{{$category->description}}
		</h1></center>
		@foreach($subcategories as $subcategory)
		@if($category->id==$subcategory->category_id)
		Move in header: <b>{{$subcategory->code}}</b><br>
		<b>{{$subcategory->description}}</b><br>
		Remarks: <b></b><br>
		<table width="100%">
			<thead>
				<tr>
					<th class="col">BUILDING</th>
					<th class='col'>UNIT</th>
					<th class="col">UNIT TYPE</th>
					<th class="col">FLOOR</th>
					<th class="col">SIZE</th>

				</tr>
			</thead>
			<tbody>
				@foreach($details as $detail)
				@if($subcategory->subcategory_id==$detail->subcategory_id)
				<tr>
					<td>{{$detail->building}}</td>
					<td>{{$detail->code}}</td>
					<td>{{$detail->type}}</td>
					<td>{{$detail->number}}</td>
					<td>{{$detail->size}}</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>
		@endif
		@endforeach
		@endforeach
		<br>
		<br>
	</body>
	</html>