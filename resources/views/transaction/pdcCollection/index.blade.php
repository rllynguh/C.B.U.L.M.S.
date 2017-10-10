@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a href="{{route("pdcCollection.index")}}"> PDC Collection</a></li>
</ol>
@endsection
@section('content')
{{-- modal pdc collection starts here --}}
<div class="modal fade" id="modalPDCCollection" tabindex="-1" role="dialog">
 {{ Form::open([
  'id' => 'frmPDC', 'class' => 'form-horizontal'
])
}}
{{ Form::hidden('myId',null,[
  'id'=> 'myId',
])
}}
{{ Form::hidden('amount',null,[
  'id'=> 'amount',
])
}}
<div class="modal-dialog" role="document">
  <div class="modal-content modal-lg modal-col-green">
    <div class="modal-header">
      <h1  class="modal-title align-center p-b-15"><span id='labelReq'>PDC COLLECTION</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
    </div>
    <div class="modal-body">
      <div class="col-sm-6">
        <center><h4>Post Dated Checks will cover these items:</h4></center>
        <div id='divBill'>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-4">
            <div class="form-group">
              <div class="form-line">
                <label class="card-inside-title">Number of PDC'S</label>
                {{ Form::number('txtPDC',null,[
                  'id' => 'txtPDC',
                  'class' => 'form-control text-center max-digits-2',
                  'data-rule' => 'quantity',
                  'autocomplete' => 'off',
                  'min' => '1',
                  'max' => '12',
                  'required' => 'required',
                ])
              }}
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-line">
            {{ Form::label('bank', 'Bank', [
              'class' => 'control-label'
            ]) 
          }}
          <div class="form-group ">
            {{ Form::select('bank', $banks,null, [
              'id' => 'bank',
              'class' => 'form-control form-line'])
            }}
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="form-line">
            <h5 class="card-inside-title">Code</h5>
            {{ Form::text('txtCode',null,[
              'id' => 'txtCode',
              'class' => 'form-control text-center',
              'autocomplete' => 'off',
              'minlength' => '10',
              'maxlength' => '40',
              'required' => 'required',
            ])
          }}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-6">
  <div id='divTable'>
  </div>
</div>
</div>
<div class="modal-footer">
  <input type='submit' class="btn btn-lg bg-brown waves-effect waves-white col-md-12" value="CONFIRM" id="btnSave">
  <input type='hidden' class="btn btn-lg bg-brown waves-effect waves-white" value="SAVE CHANGES" id="btnSaveTable">
</div>
</div>
</div>
{{Form::close()}}
</div>
{{-- modal pdc collection ends here --}}
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">CONTRACT</th>
        <th class="align-center">CLIENT</th>
        <th class="align-center">Date ISSUED</th>
        <th class="align-center">PDC'S COLLECTED</th>
        <th class="align-center">ACTION</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/pdcCollectionAjax.js")!!}
{!!Html::script("plugins/editable-table/mindmup-editabletable.min.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('pdcCollection.getData')!!}" ;
  var url="{!!route('pdcCollection.index')!!}" ;
  var update="{!!route('pdcCollection.updatePDC')!!}" ;
</script>
@endsection
