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
                                <div class="checkbox checkbox-primary">
                                    <input id="durationToggle" type="checkbox">
                                    <label class = "unselectable" for="durationToggle">
                                         Change Contract Duration
                                    </label>
                                </div>
                                <label for="duration">Contract duration change:</label>
                                <input id="duration" name="value" readonly>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type = "button" class="btn btn-primary" data-toggle="modal" data-target="#confirm-dialog">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
