 @extends('layout.coreLayout')
 @section('breadcrumbs')
 <ol class="breadcrumb breadcrumb-col-brown">
  <li><a href="{{route('myAccount.index')}}"> My Account</a></li>
</ol>
@endsection
@section('content')
<!--withdrawModal-->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog">
 {{ Form::open([
  'id' => 'myForm', 'class' => 'form-horizontal'
])
}}
<input type="hidden" name='txtBalance' value='{{$balance->balance}}'>

<div class="modal-dialog modal-md" role="document">
  <div class="modal-content modal-col-green">
    <div class="modal-header">
      <h2 class="modal-title align-center p-b-15 p-l-35">WITHDRAW<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
    </div>
    <div class="modal-body align-center">
      <div class="input-group" class="col-sm-6">
        <span class="input-group-addon">
          ₱
        </span>
        <div class="form-line">
          {{ Form::text('txtAmount',null,[
            'id'=> 'txtAmount',
            'class' => 'form-control text-center',
            'autocomplete' => 'off',
            'required' => 'required',
            'data-parsley-type' => 'number',
            'max' => '1000000',
            'min' => '1000'
          ])
        }}
      </div>
    </div>
  </div>
  <div class="modal-footer align-center">
    <button id="btnWithdraw" type="submit" class="btn btn-lg bg-light-green waves-effect waves-white col-md-12 col-sm-12"><i class="mdi-action-delete"></i> Withdraw</button>
  </div>
</div>
</div>
{{Form::close()}}
</div>
<!--withdrawModal-->
<div class="body">
  <img  class="img-circle" src="{{ asset('images/users/'.Auth::user()->picture) }}" class="user-image" height="100" width="100" alt="User Image">
  {{$balance->formatted_balance}}
  <button id="btnShow" 
  @if($balance->balance==0)
  disabled 
  @endif
  type="button" class="btn btn-lg bg-light-green waves-effect waves-white"> WITHDRAW</button>
</div>
@endsection
@section('scripts')
{{Html::script('custom/myAccountAjax.js')}}
<script type="text/javascript">
  url='{{route('myAccount.store')}}'
</script>
@endsection