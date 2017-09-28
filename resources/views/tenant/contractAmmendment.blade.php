@extends('layouts.tenantLayout')
@section('content')
<div class="container">
      <div class="card">
        <div class="card-content">
          <table class="table row-border display compact table-hover dataTable table-striped ui celled is-narrow" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Contract</th>
                <th class="align-center">Lessor</th>
                <th class="align-center">Number of Units</th>
                <th class="align-center">Date Issued</th>
                <th class="align-center">Action</th>
              </tr>
            </thead>
            <tbody id = "myList">
            </tbody>
          </table>
        </div>
      </div> <!-- end of .card -->
    </div>
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="text" class="form-control" id="psw" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
{!!Html::script("custom/contractAmmendmentAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('tenant.contractData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>

@endsection
