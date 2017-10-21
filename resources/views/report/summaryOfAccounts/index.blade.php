 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Report</a></li>
  <li><a href="{{route('summaryOfAccountsReport.index')}}">Summary of Accounts</a></li>
</ol>
@endsection
@section('content')
{{ Form::open(['data-parsley-whitespace' => 'squish', 'target' => '_blank', 'route' => 'summaryOfAccountsReport.document']) }}
<div class="body">
  <div class="col-sm-12">
    <div class="col-sm-6">
      Until date
      <label for='date' class="control-label">TO</label>
      <input required type="date" name="date">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Generate</button>
</div>
{{ Form::close() }}
@endsection