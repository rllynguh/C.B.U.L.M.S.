@extends('layouts.tenantLayout')
@section('breadcrumbs')
<h3 class = "align-center">Profile Management</h3>
@endsection
@section('content')
  <form class="form-horizontal" id = "profileForm">
    <fieldset>
      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <div class="input-group">
            <div class="form-line">
              <label for="firstnameinput
              ">First Name</label>
              <input type="text" class="form-control" id="firstnameinput" name="firstnameinput" type="text" placeholder="First Name" required autofocus value = {{$detail->first_name}}>
            </div>
          </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <div class="input-group">
            <div class="form-line">
              <label for="middlenameinput
              ">Middle Name</label>
              <input type="text" class="form-control" id="middlenameinput" name="middlenameinput" type="text" placeholder="Middle Name" required value = {{$detail->middle_name}}>
            </div>
          </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <div class="input-group">
            <div class="form-line">
              <label for="lastnameinput
              ">Last Name</label>
              <input type="text" class="form-control" id="lastnameinput" name="lastnameinput" type="text" placeholder="Last Name" required value = {{$detail->last_name}}>
            </div>
          </div>
        </div>
      </div>
      
      <div class="input-group">
        <span class="input-group-addon">
          <i class="material-icons">email</i>
        </span>
        <div class="form-line">
          <input type="email" class="form-control" id="emailinput" name="emailinput" placeholder="Email Address" required value = {{$detail->email}}>
        </div>
      </div>
      <div class="input-group">
        <span class="input-group-addon">
          <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
          <input type="password" class="form-control" d="passwordinput" name="passwordinput"" minlength="6" placeholder="Password" required>
        </div>
      </div>
      <!-- Password input-->
      <div class="input-group">
        <span class="input-group-addon">
          <i class="material-icons">lock</i>
        </span>
        <div class="form-line">
          <input type="password" class="form-control" d="password2input" name="password2input"" minlength="6" placeholder="Retype password" required>
        </div>
      </div>
      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="btnsubmit"></label>
        <div class="col-md-4">
          <button  type = 'button' id="btnSubmitChanges" name="btnsubmit" class="btn btn-block btn-lg bg-blue waves-effect">Save changes</button>
        </div>
      </div>
      <br><br><br>
    </fieldset>
  </form>
@endsection
@section('scripts')
{!!Html::script("custom/profileAjax.js")!!}
<script type="text/javascript" >
var url='{{route('tenant.account.post')}}';
</script>
@endsection