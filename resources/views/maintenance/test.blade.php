@extends('layout.coreLayout')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
@endsection
@section('content')

<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="header align-center">
      <h2>Laravel Ajax CRUD Example</h2>
    </div>
    <div class="align-center">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
      Create Item
      </button>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="align-center">Building Code</th>
          <th class="align-center">Building  Name</th>
          <th class="align-center">Location</th>
          <th class="align-center">Status</th>
          <th class="align-center">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div class="body">
    </div>
  </div>
  
<ul id="pagination" class="pagination-sm"></ul>
<!-- Create Item Modal -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" action="{{ route('test.store') }}" method="POST">
          <div class="form-group">
            {{Form::label('title','Title:',['class' => 'control-label'])}}
            {{Form::text('title',null,['class' => 'form-control','data-error' => 'Please enter title','required' => ''])}}
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label class="control-label" for="title">Description:</label>
            <textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn crud-submit btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
      </div>
      <div class="modal-body">
        <form data-toggle="validator" action="/item-ajax/14" method="put">
          <div class="form-group">
            <label class="control-label" for="title">Title:</label>
            <input type="text" name="title" class="form-control" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label class="control-label" for="title">Description:</label>
            <textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript">
var url = "<?php echo route('test.index')?>";
</script>
<script src="/js/buildingRehaulAjax.js"></script>
@endsection