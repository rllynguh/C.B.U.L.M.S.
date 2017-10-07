@extends('layout.coreLayout')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
  <li><a> Maintenance</a></li>
  <li><a href="{{route('users.index')}}"> User Accoounts</a></li>
</ol>
@endsection
@section('content')


<!--Delete MODAL-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-col-green">
      <div class="modal-header-delete">
        <h2 class="modal-title align-center p-b-15 p-l-35">DELETE<a href="javascript:void(0);" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
      </div>
      <div class="modal-body align-center">
        <p>Are you sure do you want to delete this record?</p>
      </div>
      <div class="modal-footer align-center">
        <button id="btnDelete" type="submit" class="btn btn-lg bg-red waves-effect waves-white col-md-12 col-sm-12"><i class="mdi-action-delete"></i> DELETE</button>
      </div>
    </div>
  </div>
</div>
<!--Delete MODAL-->
<div class="body">
  <table class="table table-hover dataTable" id="myTable">
    <thead>
      <tr>
        <th class="align-center">User</th>
        <th class="align-center">Email</th>
        <th class="align-center">Last Login</th>
        <th class="align-center">Role</th>
        <th class="align-center">Active</th>
        <th class="align-center">Action</th>
      </tr>
    </thead>
    <tbody id="myList">
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/userAccountAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('users.getData')!!}" ;
  var url="{!!route('users.index')!!}" ;
</script>
@endsection
