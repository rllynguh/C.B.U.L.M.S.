@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
    </div>
    
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            <button class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave">Confirm</button>
          </div>
        </div>
      </div>
      {{Form::close()}}
    </div>
    {{-- modal requirement ends here --}}
    <div class="card">
      <div class="header align-center">
        <h2>
          LIST OF REGISTRATION FOR RESERVATION
        </h2>
      </div>
      <div class="body">
        <table class="table table-hover dataTable" id="myTable">
          <thead>
            <tr>
              <th class="align-center">REGISTRATION CODE</th>
              <th class="align-center">Client</th>
              <th class="align-center">Business</th>
              <th class="align-center">Unit requested</th>
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
{!!Html::script("custom/reservationFeeCollectionAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('reservationFeeCollection.getData')!!}" ;
  var url="{!!route('reservationFeeCollection.index')!!}" ;
</script>
@endsection
