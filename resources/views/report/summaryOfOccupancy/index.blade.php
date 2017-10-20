 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Report</a></li>
  <li><a href="{{route('summaryOfOcupancyReport.index')}}"> Summary Of Occupancy</a></li>
</ol>
@endsection
@section('content')
{{ Form::open(['data-parsley-whitespace' => 'squish', 'target' => '_blank', 'route' => 'summaryOfOccupancyReport.document']) }}
<div class="body">
  <button type="submit" class="btn btn-primary">Generate</button>
</div>
{{ Form::close() }}
@endsection