<div class="modal fade" id="accept-reject-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Acceot/Reject</h4>
			</div>
			<div class="modal-body">
				{{$slot}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success">Accept</button>
				<button type="button" class="btn btn-danger">Reject</button>
			</div>
		</div>
	</div>
</div>