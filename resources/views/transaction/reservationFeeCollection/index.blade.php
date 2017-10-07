@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route("reservationFeeCollection.index")}}"> Reservation Fee Collection</a></li>
</ol>
@endsection
@section('content')
{{-- modal reserve starts here --}}
<div class="modal fade" id="modalReserve" tabindex="-1" role="dialog">
 {{ Form::open([
  'id' => 'frmReserve', 'class' => 'form-horizontal'
])
}}
{{ Form::hidden('myId',null,[
  'id'=> 'myId',
])
}}
<div class="modal-dialog" role="document">
  <div class="modal-content modal-col-green">
    <div class="modal-header">
      <h1  class="modal-title align-center p-b-15"><span id='labelReq'>Reservation</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
    </div>
    <div class="modal-body">
      Reserve all units from this transaction?
      <div id='divRes'>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave">CONFIRM</button>
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
{!!Html::script("custom/reservationFeeCollectionAjax.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('reservationFeeCollection.getData')!!}" ;
  var url="{!!route('reservationFeeCollection.index')!!}" ;
</script>
@endsection
