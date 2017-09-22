@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Transaction</a></li>
  <li><a> Billing and Collection</a></li>
  <li><a href="{{route('collection.index')}}">Collection</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  {{-- modal collection starts here --}}
  <div class="modal fade" id="modalCollection" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-col-green">
        {{ Form::open([
          'id' => 'frmCollection', 'class' => 'form-horizontal'
          ])
        }}
        {{ Form::hidden('myId',null,[
          'id' => 'myId'
          ])
        }}
        <div class="modal-header">
          <h1  class="modal-title align-center p-b-15"><span>Collect Payment</span><a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
        </div>
        <div class="modal-body">
          <div id='divCollect' class="col-sm-6">
          </div>
          <div class="col-sm-6">
           <div class="form-group">
             <div class="col-sm-6">
              Bank
            </div>
            <div class="form-line col-sm-6">

              {{ Form::select('bank',$banks, null, [
                'id' => 'bank',
                'required' => 'required',
                'class' => 'form-control align-center'])
              }}
            </div>
            <div class="col-sm-6">
              Date Collected
            </div>
            <div class="form-line col-sm-6">
              <input class="form-control align-center" type="date" required=""  name="dateCollected"> <br>  
            </div>
            <div class="col-sm-6">
              Amount Collected
            </div>
            <div class="input-group" class="col-sm-6">
              <span class="input-group-addon">
                ₱
              </span>
              <div class="form-line">
               {{ Form::text('txtAmount',null,[
                'id'=> 'txtAmount',
                'class' => 'form-control text-center',
                'autocomplete' => 'off',
                'required' => 'required',
                'data-parsley-type' => 'number',
                'max' => '1000000',
                'min' => '1000'
                ])
              }}
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="modal-footer m-t--30">
      <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> Collect payment</span></button>
    </div>
    {{Form::close()}}
  </div>
</div>
</div>
{{-- modal collection ends here --}}
<table class="table table-hover dataTable" id="myTable">
  <thead>
    <tr>
      <th class="align-center">BILLING CODE</th>
      <th class="align-center">AMOUNT DUE</th>
      <th class="align-center">AMOUNT PAID</th>
      <th class="align-center">ACTION</th>
    </tr>
  </thead>
  <tbody id="myList">
  </tbody>
</table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/collectionAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('collection.getData')!!}" ;
  var url="{!!route('collection.index')!!}" ;
</script>
@endsection
