@extends('layouts.tenantLayout')
@section('content')
<form class="form-horizontal" id = "profileForm">
<fieldset>

<!-- Form Name -->
<legend>Account</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="firstnameinput">First Name</label>  
  <div class="col-md-5">
  <input id="firstnameinput" name="firstnameinput" type="text" placeholder="First Name" class="form-control input-md" required="" value = {{$detail->first_name}}>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="middlenameinput">Middle Name</label>  
  <div class="col-md-5">
  <input id="middlenameinput" name="middlenameinput" type="text" placeholder="Middle Name" class="form-control input-md" required="" value = {{$detail->middle_name}}>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lastnameinput">Last Name</label>  
  <div class="col-md-5">
  <input id="lastnameinput" name="lastnameinput" type="text" placeholder="Last name" class="form-control input-md" required="" value = {{$detail->last_name}}>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emailinput">Email</label>  
  <div class="col-md-5">
  <input id="emailinput" name="emailinput" type="text" placeholder="email" class="form-control input-md" required="" value = {{$detail->email}}>
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Password</label>
  <div class="col-md-5">
    <input id="passwordinput" name="passwordinput" type="password" placeholder="Enter new password" class="form-control input-md">
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password2input">Confirm Password</label>
  <div class="col-md-5">
    <input id="password2input" name="password2input" type="password" placeholder="Confirm password" class="form-control input-md">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnsubmit"></label>
  <div class="col-md-4">
    <button  type = 'button' id="btnSubmitChanges" name="btnsubmit" class="btn btn-success">Save changes</button>
  </div>
</div>

</fieldset>
</form>


@endsection
@section('scripts')
{!!Html::script("custom/profileAjax.js")!!}
<script type="text/javascript" >
	var url='{{route('tenant.account.post')}}';
</script>
@endsection
