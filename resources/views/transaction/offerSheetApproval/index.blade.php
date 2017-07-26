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
            Offer Sheets for Approval 
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">OFFER SHEET CODE</th>
                <th class="align-center">REGISTRATION CODE</th>
                <th class="align-center">LESSOR</th>
                <th class="align-center">Date PROPOSED</th>
                <th class="align-center">UNITS OFFERED</th>
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
{!!Html::script("custom/offerSheetApprovalAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('offerSheetApproval.getData')!!}" ;
  var url="{!!route('offerSheetApproval.index')!!}" ;
</script>
@endsection
