 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Report</a></li>
  <li><a href="{{route('collectionReport.index')}}"> Collection</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  {{ Form::open(['data-parsley-whitespace' => 'squish', 'target' => '_blank', 'route' => 'collectionReport.document']) }}
  <div class="body">
    <div class="col-sm-12">
      <h3>Date Collected</h3>
      <label for='from' class="control-label">FROM</label>
      <input required type="date" name="from">
      <label for='from' class="control-label">TO</label>
      <input required type="date" name="to">
    </div>
    <button type="submit" class="btn btn-primary">Generate</button>
  </div>
  {{ Form::close() }}
</div>
@endsection