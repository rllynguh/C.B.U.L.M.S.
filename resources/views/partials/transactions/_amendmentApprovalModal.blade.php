<!-- Contract Amendment Modal -->
<div class="modal fade" id="amendmentApprovalModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Unit Requests</h4>
            </div>
            <div class="modal-body">
                <form action="" role="form">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <div id = "requests" class = "accordion">
                                    <h4> Units to requested </h4>
                                </div>
                                <h4 id ="duration"> Duration </h4>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class = "accordion" id = "sortable1">
                                <h4> Units to be kept </h4>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class="accordion" id = "sortable2">
                                <h4> Units to discarded </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label class = "unselectable" for="tenantRemark">
                                         Remarks
                                    </label>
                            <textarea name="tenantRemark" id="tenantRemark" class="form-control" rows="3" required="required"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnAction" data-toggle="modal" data-target="#confirm-dialog" id = "btnAccept">Accept</button>
                <button type = "button" class="btn btn-danger btnAction" data-toggle="modal" data-target="#confirm-dialog" id="btnReject">Reject</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirm-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b> Are you sure? </b>
            </div>
            <div class="modal-body">
                <span>This will send a request</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id = "btnSubmit" data-dismiss="modal" >Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>