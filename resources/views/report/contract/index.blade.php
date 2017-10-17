 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Report</a></li>
  <li><a href="{{route('contractReport.index')}}"> Contract</a></li>
</ol>
@endsection
@section('content')
{{ Form::open(['data-parsley-whitespace' => 'squish', 'target' => '_blank', 'route' => 'contractReport.document']) }}
<div class="body">
  <div class="col-sm-12">
    <div class="col-sm-6">
      <h3>Contract Starting Date</h3>
      <label for='from' class="control-label">FROM</label>
      <input required type="date" name="from">
      <label for='from' class="control-label">TO</label>
      <input required type="date" name="to">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Generate</button>
</div>
{{ Form::close() }}
@endsection