<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog">
	{{ Form::open([
	'id' => 'myForm', 'class' => 'form-horizontal'
	])
	}}
	<input type="hidden" name='txtBalance' value='0' id = "withdraw-total">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content modal-col-green">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id = 'withdraw-title'>Balance: </h4>
			</div>
			<div class="modal-body align-center">
				<div class="input-group" class="col-sm-6">
					<span class="input-group-addon">
						₱
					</span>
					<div class="form-line">
						{{ Form::text('txtWithdraw',null,[
						'id'=> 'txtWithdraw',
						'class' => 'form-control text-center',
						'autocomplete' => 'off',
						'required' => 'required',
						'data-parsley-type' => 'number',
						'max' => '1000000',
						'min' => '1000'
						])
						}}
					</div>
				</div>
			</div>
			<div class="modal-footer align-center">
				<button id="btnWithdraw" class="btn btn-lg bg-light-green waves-effect waves-white col-md-12 col-sm-12"><i class="mdi-action-delete"></i> Withdraw</button>
			</div>
		</div>
	</div>
	{{Form::close()}}
</div>