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
      {{-- modal collection starts here --}}
      <div class="modal fade" id="modalCollection" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
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
              <div id='divCollect'>
              </div>
              Bank
              {{ Form::select('bank',$banks, null, [
                'id' => 'bank',
                'required' => 'required',
                'class' => 'form-control form-line align'])
              }}
              Date Collected
              <div class="form-line">
                <input class="form-control align-center" type="date" required=""  name="dateCollected"> <br>  
              </div>
              Amount Collected
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
              <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> Collect payment</span></button>
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
      {{-- modal collection ends here --}}
      <div class="card">
        <div class="header align-center">
          <h2>
            List of Billing for Collection 
          </h2>
        </div>
        <div class="body">
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
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/collectionAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('collection.getData')!!}" ;
  var url="{!!route('collection.index')!!}" ;
</script>
@endsection
