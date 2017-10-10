<!-- Contract Ammendment Modal -->
<div class="modal fade" id="modal-alter-contract">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Unit Requests</h4>
            </div>
            <div class="modal-body">
                <form action="" role="form">
                    <legend>Form title</legend>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <div id = "requests" class = "accordion">
                                    <h4> Units to requested </h4>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox2" type="checkbox" checked="">
                                    <label class = "unselectable" for="checkbox2">
                                         Change Contract Duration
                                    </label>
                                </div>
                                <input type="date" name="" id="input" class="form-control" value="" required="required" title="">
                                
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
                                <div class="s_panel">
                                    <h3>Unit 3</h3>
                                    <div>Unit details</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-toggle='modal' data-target= '#createRequest' >Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Unit Request Modal  -->
<div class="modal fade" id="createRequest">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">Unit Request Specifications</h2>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="header">
                        <a href="#" class="btn btn-primary btn-primary" onclick="fields();"><span class="glyphicon glyphicon-plus"></span> Add unit</a>
                    </div>
                    <div class="body">
                        <form action="" method="POST" role="form" id = 'testform'>
                        <fieldset>
                            <div class="panel-body" id = "fields">
                                <div class = removeclass1>
                                <div class="col-sm-2 nopadding">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="control-label">Building Type*</label>
                                            <div class="form-line">
                                            <select class="form-control form-line" id="builtype" name="builtype[]"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 nopadding">
                                <div class="form-group">
                                    <label class="control-label">Floor #*</label>
                                    <div class="form-line">
                                    <select class="form-control form-line" id="floor" name="floor[]"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="control-label">Unit Type*</label>
                                    <div class="form-line">
                                        <select class="form-control form-line" id="utype" name="utype[]">
                                            <option value="0">Raw</option>
                                            <option value="1">Shell</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label class="control-label">Size*</label>
                                <div class="form-line">
                                <select class="form-control form-line" id="size" name="size[]"></select>
                            </div>
                        </div>
                       
                    </div>
                     <div class="col-sm-2 nopadding">
                        <br>
                            <a href="#" onclick = "remove_fields(1);" class="btn btn-primary btn-danger"><span class="glyphicon glyphicon-minus"></span> Remove Unit</a>
                        </div>
                    <div class="col-sm-12 nopadding">
                        <div class="form-group">
                            <label class="control-label">Remarks*</label>
                            <div class="form-line">
                                <textarea class="form-control form-line" id="remarks" name="remarks[]" value=""></textarea>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </fieldset>
        </form>
        </div>
    </div>
</div>
<div class="modal-footer" id = "requestFooter">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id = "btnSubmitUnitRequest" onclick="addUnitRequest()">Save changes</button>

</div>
</div>
</div>
</div>