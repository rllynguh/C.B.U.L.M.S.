@extends('layouts.tenantLayout')
@section('content')
<section>
    <div class="wizard">
        <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                        <span class="round-tab">
                            <i class="glyphicon glyphicon-folder-open"></i>
                        </span>
                    </a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                        <span class="round-tab">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </span>
                    </a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                        <span class="round-tab">
                            <i class="glyphicon glyphicon-picture"></i>
                        </span>
                    </a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                        <span class="round-tab">
                            <i class="glyphicon glyphicon-ok"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Form Contents -->
        <form role="form" id = "requestUnitsForm">
            {{csrf_field()}}
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="step1">
                    <div class="funkyradio">
                        <div class="funkyradio-success">
                            <input type="radio" name="radio" id="newContract" checked/>
                            <label for="newContract">New Contract</label>
                        </div>
                        
                        <div id = "test" style="display: none;">
                            <select class = "selectMenu" id = "testa">
                            </select>
                        </div>
                    </div>
                    <ul class="list-inline pull-right">
                       <button type="button" class="btn btn-primary next-step">Next Step</button>   
                    </ul>
                </div>
                
                <div class="tab-pane" role="tabpanel" id="step2">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                Unit Specifications
                                </h2>
                                <div class="input-group-btn pull-right m-r--5 header-dropdown">
                                    <button class="btn btn-success" type="button"  onclick="fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                                </div>
                            </div>
                            <div class="body">
                                <fieldset>
                                    <div class="panel-body">
                                        <div id="fields"></div>
                                        <div class="clear"></div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                    </ul>
                </div>
                <div class="tab-pane" role="tabpanel" id="step3">
                    <h3>Remarks</h3>
                    <fieldset>
                        <div class="panel-body">
                            <div class="col-sm-12 nopadding">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('duration', 'Desired Duration of Contract*', [
                                        'class' => 'control-label'
                                        ])
                                        }}
                                        {{ Form::number('duration', null, [
                                        'id' => 'duration',
                                        'class' => 'form-control form-line',
                                        'max' => '3',
                                        'required' => 'required',
                                        'autocomplete' => 'off',
                                        'data-parsley-type' => 'number',
                                        'required' => ''
                                        ])
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 nopadding">
                                <div class="form-group">
                                    <label class="control-label">Remarks*</label>
                                    <div class="form-line">
                                        <textarea required="" class="form-control form-line" id="header_remarks" name="header_remarks" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                        <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                    </ul>
                </div>
                <div class="tab-pane" role="tabpanel" id="complete">
                    <h3>Complete</h3>
                    <p>You have successfully completed all steps.</p>
                    <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12 col-sm-12" id="btnRequestSubmit" value="add"><i class="mdi-content-save"></i><span id='lblButton'> SAVE</span></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('styles')
{!!Html::style("css/tenant/custom.css")!!}
@endsection
@section('scripts')
<script type="text/javascript">
var dataurl="{{route("buildings.getData")}}";
url="{{route("buildings.index")}}";
urlSubmit="{{route("tenant.requestUnitStore")}}";
</script>
<script>
$( function() {
fields();
});
</script>
@endsection