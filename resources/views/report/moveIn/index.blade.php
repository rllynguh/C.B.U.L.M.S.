 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Report</a></li>
  <li><a href="{{route('moveInReport.index')}}"> Move In</a></li>
</ol>
@endsection
@section('content')
<div class="body">
  {{ Form::open(['data-parsley-whitespace' => 'squish', 'target' => '_blank', 'route' => 'moveInReport.document']) }}
  <div class="col-sm-6">
   <h3>Date Moved In</h3>
   <label for='from' class="control-label">FROM</label>
   <input required type="date" name="from">
   <label for='from' class="control-label">TO</label>
   <input required type="date" name="to">
 </div>
 <div col-sm-6>
  <h4>Group By</h4>
  <select required name='groupBy'>
    <option value='tenants.id'>Tenant</option>
    <option value='date_moved_in'>Date Moved In</option>
  </select>
  <h4>Order Units by</h4>
  <select required name='orderUnitsBy'>
    <option value='units.size'>Size</option>
    <option value='floors.number'>Floor</option>
  </select>
</div>
<button type="submit" class="btn btn-primary pull-right">Generate</button>
{{ Form::close() }}
@endsection