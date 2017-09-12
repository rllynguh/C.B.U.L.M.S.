@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      REQUIREMENT VALIDATION
    </div>
    
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     {{-- modal requirement starts here --}}
     <div class="modal fade" id="modalRequirement" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        {{Form::open([
          'id' => 'frmRequirement'
          ])}}
          <div class="modal-content modal-col-green">
            <div class="modal-header">
              <h1  class="modal-title align-center p-b-15"><span id='labelReq'>Validate Requirements</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
            </div>
            <div class="modal-body">
              <div id='divReq'>
              </div>
            </div>
            <div class="modal-footer m-t--30">
              <button id='btnSave' type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" ><i class="mdi-content-save"></i><span> SAVE</span></button>
            </div>
          </div>
          {{Form::close()}}
        </div>
      </div>
      {{-- modal requirement ends here --}}
      <div class="card">
        <div class="header align-center">
          <h2>
            List of Registration with Pending Requirements 
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Registration Code</th>
                <th class="align-center">Client</th>
                <th class="align-center">Requirements Fulfilled</th>
                <th class="align-center">Action</th>
              </tr>
            </thead>
            <tbody id="myList">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/requirementValidationAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('requirementValidation.getData')!!}" ;
  var url="{!!route('requirementValidation.index')!!}" ;
  // var urlstorereq="{!!route('requirementAssigning.storeRequirements')!!}"
  // var urlupdatereq="{!!route('requirementAssigning.updateRequirements')!!}"
</script>
@endsection
