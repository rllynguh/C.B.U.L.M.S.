@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route("pdcCollection.index")}}"> PDC Collection</a></li>
</ol>
@endsection
@section('content')
{{-- modal pdc collection starts here --}}
<div class="modal fade" id="modalPDCValidation" tabindex="-1" role="dialog">
 {{ Form::open([
  'id' => 'frmPDCValidation', 'class' => 'form-horizontal'
])
}}
{{ Form::hidden('myId',null,[
  'id'=> 'myId',
])
}}
{{ Form::hidden('status',null,[
  'id'=> 'status',
])
}}
<div class="modal-dialog" role="document">
  <div class="modal-content  modal-col-green">
    <div class="modal-header">
      <h1  class="modal-title align-center p-b-15"><span id='labelReq'>What Would you like to do with this PDC?</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
    </div>
    <div id='content' class="modal-body">

    </div>
    <div class="modal-footer">
      <button class="btn btn-lg bg-brown waves-effect waves-white" id="btnAccept">Accept</button>
      <button class="btn btn-lg bg-orange waves-effect waves-white" id="btnReject">Reject</button>
    </div>
  </div>
</div>
{{Form::close()}}
</div>
{{-- modal pdc collection ends here --}}
<div id='divTable' class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">CONTRACT</th>
        <th class="align-center">CLIENT</th>
        <th class="align-center">DATE ISSUED</th>
        <th class="align-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/pdcValidationAjax.js")!!}
{!!Html::script("plugins/editable-table/mindmup-editabletable.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('pdcValidation.getData')!!}" ;
  var url="{!!route('pdcValidation.index')!!}" ;
</script>
@endsection
