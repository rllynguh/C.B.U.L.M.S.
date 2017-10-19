@extends('layouts.tenantLayout')
@section('content')
          <table class="table row-border display compact table-hover dataTable table-striped ui celled is-narrow" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Contract</th>
                <th class="align-center">Lessor</th>
                <th class="align-center">Number of Units</th>
                <th class="align-center">Date Issued</th>
                <th class="align-center">Action</th>
              </tr>
            </thead>
            <tbody id = "body">
            </tbody>
          </table>
   @include('partials.tenant._contractDetailsModal')
   @include('partials.tenant._contractAmendmentModal')
@endsection

@section('scripts')
{!!Html::script("custom/contractAmendmentAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('tenant.contractData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
  var urlUnits = "{!!route('tenant.getUnits')!!}";
  var urlStore = "{!!route('tenant.storeRequest')!!}";
</script>


@endsection
@section('styles')
 <style type="text/css" media="screen">
 .unselectable {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
 </style>
@endsection