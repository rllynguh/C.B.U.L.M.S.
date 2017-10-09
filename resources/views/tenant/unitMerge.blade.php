@extends('layouts.tenantLayout')
@section('content')
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <div class="accordion" id="sortable1">
    <h4> Units Owned </h4>
    @forelse ($units as $unit)
    <div class="s_panel">
      <h3>{{$unit->unit_code}}</h3>
      <div>
        <b>Unit Type</b>: {{$unit->unit_type}}<br>
        <b>Floor #</b>:{{$unit->unit_floorNum}}
      </div>
    </div>
    @empty
    <h3> No units under contract
    @endforelse
    <div class="s_panel">
      <h3>Unit 2</h3>
      <div>Unit details </div>
    </div>
  </div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <div class="accordion" id = "sortable2">
    <h4> Units to be merged </h4>
    <div class="s_panel">
      <h3>Unit 3</h3>
      <div>Unit details</div>
    </div>
  </div>
  <button class="btn btn-large btn-block btn-primary" type="button">Merge</button>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <h4> Merged unit info </h4>
  <textarea name="" id="input" class="form-control" rows="3" required="required"></textarea>
</div>
@endsection
@section('scripts')
<script>
var dataurl="{!!route('offerSheetApproval.getData')!!}" ;
var url="{!!route('offerSheetApproval.index')!!}" ;
urlbtype="{{route("custom.getBuildingType")}}";
buil_type_url="{{route("custom.getBuildingType")}}";
floor_url="{{route("custom.getFloor")}}";
range_url="{{route("custom.getRange")}}";
$( function() {
  $('.accordion').accordion({
collapsible: true,
active: false,
height: 'fill',
header: 'h3',
icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }
}).sortable({
items: '.s_panel',
placeholder: "ui-state-highlight"
});
$( "#sortable1, #sortable2" ).sortable({
connectWith: ".accordion"
});
$( "#sortable1, #sortable2, #sortable3" ).disableSelection();
} );
</script>
@endsection
@section('styles')
<style>
.ui-state-highlight { height: 2em; line-height: 1.2em; }
</style>
@endsection