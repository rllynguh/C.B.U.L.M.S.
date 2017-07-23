@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
	<div class="body">
		<div class="block-header">
			<h2 class="align-center">Registration Acceptance</h2>
		</div>
		
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header align-center">
					<h2>
						{{$tenant->code}}
						<div class="switch"><label>Accept<input name='checkboxReject' type="checkbox" id="checkboxReject" value="ad"><span class="lever switch-col-red"></span>Reject</label></div>
					</h2>
				</div>

				Representative: {{$tenant->name}}
				<br>
				Company: {{$tenant->description}}
				<div class="body">
					<table class="table table-hover dataTable" id="myTable">
						<thead>
							<tr>
								<th class="align-center">Registration Detail</th>
								<th class="align-center">Preferred Building Type</th>
								<th class="align-center">Preferred Unit Size Range</th>
								<th class="align-center">Preferred Unit Type</th>
								<th class="align-center">Preferred Floor</th>
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
									<div class="switch"><label>Accept<input class="regi-detail" type="checkbox" id="regi-detail-id" value="{{$result->detail_id}}"><span class="lever switch-col-red"></span>Reject</label></div>
									<input type="hidden" value="{{$result->detail_id}}" name="regi_id[]">
									<input type="hidden" name="regi_is_active[]" id='regi{{$result->detail_id}}' value='0'>

								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> SAVE</span></button>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetShowAjax.js")!!}
<script type="text/javascript">

	$(document).ready(function()
	{ 
		$(this).on('change', '#IsActive',function(e)
		{ 
			if($(this).is(":checked")) 
				$(".regi-detail").attr('disabled','disabled');
			else
				$(".regi-detail").removeAttr('disabled','disabled');

		}
		);
		$(this).on('change', '.regi-detail',function(e)
		{ 
			myId=$(this).val();
			if($(this).is(":checked")) 
				$("#regi"+myId).val('1');
			else
				$("#regi"+myId).val('0');
		}
		);

	});
</script>
@endsection
