@extends('layout.coreLayout')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="header align-center">
        <h2>Buildings wooo</h2>
        <nav class="breadcrumb">
          <a class="breadcrumb-item" href="#">Home</a>
          <a class="breadcrumb-item" href="#">Library</a>
          <a class="breadcrumb-item" href="#">Data</a>
          <span class="breadcrumb-item active">Bootstrap</span>
        </nav>
      </div>
      <div class="align-center">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#buildingCreateModal" id = "btnShowCreate">
        Create Item
        </button>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="header align-center">
      <h2>
      LIST OF BUILDINGS
      </h2>
    </div>
    <div class="body">
      <table class="table row-border display compact table-hover dataTable table-striped ui celled" id="myTable">
        <thead>
          <tr>
          </tr>
        </thead>
        <tbody id="body">
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--MODAL-->
@include('partials.maintenance._building-modals')
<!--MODAL-->
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.semanticui.min.css">
<style type="text/css" media="screen">
.breadcrumb-item::after {
content: "/";
}
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript">
var url = "<?php echo route('test.index')?>";
var dataurl="{{route("buildings.getData")}}";
urlbtype="{{route("custom.getBuildingType")}}";
urlprov="{{route("custom.getProvince")}}";
</script>
<script src="/js/buildingRehaulAjax.js"></script>
@endsection