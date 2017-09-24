@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Requirement
  </a></li>
  <li><a href="{{route("registrationApproval.index")}}"> Requirements Assigning</a></li>
</ol>
@endsection
@section('content')
{{-- modal requirement starts here --}}
<div class="modal fade" id="modalRequirement" tabindex="-1" role="dialog">
 {{ Form::open([
  'id' => 'frmRequirement', 'class' => 'form-horizontal'
  ])
}}
{{ Form::hidden('idReg',null,[
  'id'=> 'idReg',
  ])
}}
<div class="modal-dialog" role="document">
  <div class="modal-content modal-col-green">
    <div class="modal-header">
      <h1  class="modal-title align-center p-b-15"><span id='labelReq'>Add Requirements</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
    </div>
    <div class="modal-body">
      <div id='divReq'>

      </div>
    </div>
    <div class="modal-footer">
      <button value='add' type="button" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSaveReq" value="add"><i class="mdi-content-save"></i><span id="buttonReq"> Add</span></button>
    </div>
  </div>
</div>
{{Form::close()}}
</div>
{{-- modal requirement ends here --}}
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">REGISTRATION CODE</th>
        <th class="align-center">CLIENT</th>
        <th class="align-center">BUSINESS</th>
        <th class="align-center">UNIT REQUESTED</th>
        <th class="align-center">ACTION</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>

@endsection
@section('scripts')
{!!Html::script("custom/requirementAssigningAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('requirementAssigning.getData')!!}" ;
  var url="{!!route('requirementAssigning.index')!!}" ;
  var urlstorereq="{!!route('requirementAssigning.storeRequirements')!!}"
  var urlupdatereq="{!!route('requirementAssigning.updateRequirements')!!}"
</script>
@endsection
