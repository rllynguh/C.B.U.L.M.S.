 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Report</a></li>
  <li><a href="{{route('moveInReport.index')}}"> Billing</a></li>
</ol>
@endsection
@section('content')
{{ Form::open(['target' => '_blank', 'route' => 'billingReport.document']) }}
<div class="body">
  <div class="col-sm-12">
    <h3>Date of Billing</h3>
    <label for='from' class="control-label">FROM</label>
    <input required type="date" name="from">
    <label for='from' class="control-label">TO</label>
    <input required type="date" name="to">
  </div>
  <button type="submit" class="btn btn-primary">Generate</button>
</div>
{{ Form::close() }}
@endsection