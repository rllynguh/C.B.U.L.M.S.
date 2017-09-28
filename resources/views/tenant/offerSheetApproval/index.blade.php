@extends('layouts.tenantLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{url('/tenant')}}"><i class="mdi-action-home"></i> Home</a></li>
  <li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
  <li><a href="{{route("offerSheetApproval.index")}}"><i class="mdi-action-thumbs-up-down"></i> Offer Sheet Approval</a></li>
</ol>
@endsection
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
          <table class="table row-border display compact table-hover dataTable table-striped ui celled" id="myTable">
            <thead>
              <tr>
                <th class="align-center">OFFER SHEET CODE</th>
                <th class="align-center">REGISTRATION CODE</th>
                <th class="align-center">LESSOR</th>
                <th class="align-center">DATE PROPOSED</th>
                <th class="align-center">UNITS OFFERED</th>
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
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetApprovalAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('offerSheetApproval.getData')!!}" ;
  var url="{!!route('offerSheetApproval.index')!!}" ;
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>
@endsection
