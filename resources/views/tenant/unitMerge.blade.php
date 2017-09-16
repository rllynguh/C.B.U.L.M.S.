@extends('layout.tenantNav')
@section('content')
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<h3> Units Owned </h3>
	
	<div class="accordion" id="sortable1">
    <div class="s_panel">
         <h3>First header</h3>
        <div>First content panel</div>
    </div>
    <div class="s_panel">
         <h3>Second header</h3>
        <div>Second content panel</div>
    </div>
</div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<h3> Units to be merged </h3>
	<div class="accordion" id = "sortable2">
	    <div class="s_panel">
	         <h3>First header</h3>
	        <div>First content panel</div>
	    </div>
	    <div class="s_panel">
	         <h3>Second header</h3>
	        <div>Second content panel</div>
	    </div>
	</div>
</div>

@endsection
@section('scripts')
<script>
$( function() {
	$('.accordion').accordion({
        collapsible: true,
        active: false,
        height: 'fill',
        header: 'h3'
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