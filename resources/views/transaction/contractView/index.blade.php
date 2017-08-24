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
      <div class="card">
        <div class="header align-center">
          <h2>
            Offer Sheets for Contract Creation 
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Contract</th>
                <th class="align-center">Lessor</th>
                <th class="align-center">Number of Units</th>
                <th class="align-center">Date Issued</th>
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
{!!Html::script("custom/contractViewAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('contract.getData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
</script>
@endsection
