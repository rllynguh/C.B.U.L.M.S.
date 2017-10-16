<div class="modal fade" id="contractTerminationModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Contract Termination</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<input type="text" id="name" placeholder="Penalty name">
					<input type="number" id="value" min="0" step="1">
					<button type="button" class="btn btn-success" id = "add-row">Add row</button>
				</div>
				<table class="table table-striped table-hover table-bordered" id = "tablePenalties">
					<thead>
						<tr>
							<th class = 'align-center' width="40%">Penalty Name</th>
							<th class = 'align-center'>Amount</th>
							<th class = 'align-center'>Select</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<td>Security Deposit</td>
							<td id = "security_deposit" colspan="2" style="width:100%" class = "align-center"></td>
						</tr>
					<tr>
						<td>Less: Penalty Total</td>
						<td id = "total" colspan="2" style="width:100%" class = "align-center">0</td>
					</tr>
					<tr>
						<td>Remaining: </td>
						<td id = "remaining" colspan="2" style="width:100%" class = "align-center">0</td>
					</tr>
					</tfoot>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id = "btnTerminateContract" class="btn btn-danger">Terminate Contract</button>
			</div>
		</div>
	</div>
</div>