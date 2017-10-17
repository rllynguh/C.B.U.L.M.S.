<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="_token" content="{{ csrf_token() }}" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, 
  user-scalable=no" name="viewport">
  <title>Majent | Lease Management System</title>
  <link rel="icon" {{ asset('images/icon1.ico') }}">
  {!!Html::style("plugins/bootstrap/css/bootstrap.min.css")!!}
  {!!Html::style("plugins/node-waves/waves.min.css")!!}
  {!!Html::style("plugins/animate-css/animate.min.css")!!}
  {!!Html::style("css/style.min.css")!!}
  {!!Html::style("css/parsleyStyle.min.css")!!}
  {!!Html::style("css/themes/all-themes.min.css")!!}
  {!!Html::style("css/minimal-pace.min.css")!!}
  {!!Html::style("plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css")!!}
  @yield("styles")
</head>

<body class="theme-brown">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <div class="logo">
          {{ HTML::image('images/Majent.png') }}
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <!-- Notifications -->
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
              <i class="mdi-social-notifications"></i>
              <span id='notif_count' class="label-count">{{$notification->count}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">NOTIFICATIONS</li>
              <li class="body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 254px;"><ul id='notifBody' class="menu" style="overflow: hidden; width: auto; height: 254px;">
                  @foreach($notification->list as $notif)
                  <li>
                    <a href="{{$notif->link}}" id='{{$notif->id}}' class="notification waves-effect waves-block">
                     {{--  <div class="icon-circle bg-light-green">
                        <i class="mdi-action-report-problem"></i>
                      </div> --}}
                      <div class="menu-info">
                        <h4>{{$notif->title}}</h4>
                        <p>
                          <i class="mdi-action-schedule"></i> {{$notif->date_issued}}
                        </p>
                      </div>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <li class="footer">
                <a href="javascript:void(0);">View All Notifications</a>
              </li>
            </ul>
          </li>
          <!-- #END# Notifications -->
          <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="mdi-navigation-more-vert"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <section>
    <aside id="leftsidebar" class="sidebar">
      <div class="user-info">
        <div class="image p-l-80">
          <img src="{{ asset('images/users/'.Auth::user()->picture) }} " class="user-image" height="60" width="60" alt="User Image">
        </div>
        <div class="info-container m-t--10">
          <div class="name align-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->first_name }} {{Auth::user()->last_name}}</div>
          <div class="email align-center">{{Auth::user()->email}}</div>
          <div class="btn-group user-helper-dropdown m-b-15">
            <i class="mdi-hardware-keyboard-arrow-down" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
            <ul class="dropdown-menu pull-right">
              <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-social-person pull-left"></i>Profile</a></li>
              <li role="seperator" class="divider"></li>
              <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-social-group pull-left"></i>Followers</a></li>
              <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-action-shopping-cart pull-left"></i>Sales</a></li>
              <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-action-grade pull-left"></i>Likes</a></li>

              <li role="seperator" class="divider"></li>
              <li>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="waves-lime">
                <i class="mdi-action-exit-to-app pull-left"></i>
                Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="menu hover-expand-effect">
      <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="/" class=" waves-yellow">
            <i class="mdi-action-home"></i>
            <span>Home</span>
          </a>
        </li>
        <!--MAINTENANCE-->
        <li 
        class="{{strpos(Request::path(),'maintenance') ? 'active' : ''}}">
        <a href="javascript:void(0);" class="menu-toggle waves-yellow">
          <i class="mdi-action-settings"></i>
          <span>Maintenance</span>
        </a>
        <ul class="ml-menu">
          <li class="
          {{Request::path() == 'admin/maintenance/buildingtypes' ? 'active' : ''}}
          {{Request::path() == 'admin/maintenance/buildings' ? 'active' : ''}}
          {{Request::path() == 'admin/maintenance/floors' ? 'active' : ''}}
          {{Request::path() == 'admin/maintenance/units' ? 'active' : ''}}
          ">
          <a href="javascript:void(0);" class="menu-toggle waves-yellow">
            <i class="mdi-communication-business"></i>
            <span>Building</span>
          </a>
          <ul class="ml-menu">
            <li class="{{Request::path() == 'admin/maintenance/buildingtypes' ? 'active' : ''}}
            ">
            <a href="{{route('buildingtypes.index')}}" class="waves-yellow">
              <span>Building Type</span>
            </a>
          </li>

          <li class="{{Request::path() == 'admin/maintenance/buildings' ? 'active' : ''}}">
            <a href="{{route('buildings.index')}}" class="waves-yellow">
              <span>Buildings</span>
            </a>
          </li>
          <li class="{{Request::path() == 'admin/maintenance/floors' ? 'active' : ''}}"> 
            <a href="{{route('floors.index')}}" class="waves-yellow">
              <span>Floors</span>
            </a>
          </li>
          <li class="{{Request::path() == 'admin/maintenance/units' ? 'active' : ''}}">
            <a href="{{route('units.index')}}" class="waves-yellow">
              <span>Units</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="
      {{Request::path() == 'admin/maintenance/parkareas' ? 'active' : ''}}
      {{Request::path() == 'admin/maintenance/parkspaces' ? 'active' : ''}}
      ">
      <a href="javascript:void(0);" class="menu-toggle waves-yellow">
        <i class="mdi-maps-directions-car"></i>
        <span>Parking</span>
      </a>
      <ul class="ml-menu">
        <li class="
        {{Request::path() == 'admin/maintenance/parkareas' ? 'active' : ''}}
        ">
        <a href="{{route('parkareas.index')}}" class="waves-yellow">
          <span>Parking Area</span>
        </a>
      </li>

      <li class="
      {{Request::path() == 'admin/maintenance/parkspaces' ? 'active' : ''}}
      ">
      <a href="{{route('parkspaces.index')}}" class="waves-yellow">
        <span>Parking Space</span>
      </a>
    </li>
  </ul>
</li>
<li class="
{{strpos(Request::path(),'rate') ? 'active' : '' ? 'active' : ''}}
">
<a href="javascript:void(0);" class="menu-toggle waves-yellow">
  <i class="mdi-editor-attach-money"></i>
  <span>Rates</span>
</a>
<ul class="ml-menu">
  <li class="
  {{Request::path() == 'admin/maintenance/marketrates' ? 'active' : ''}}
  ">
  <a href="{{route('marketrates.index')}}" class="waves-yellow">
    <span>Market Rates</span>
  </a>
</li>

<li class="
{{Request::path() == 'admin/maintenance/parkrates' ? 'active' : ''}}
">
<a href="{{route('parkrates.index')}}" class="waves-yellow">
  <span>Parking Rates</span>
</a>
</li>
</ul>
</li>
<li class="
{{Request::path() == 'admin/maintenance/banks' ? 'active' : ''}}
">
<a href="{{route("banks.index")}}" class="waves-yellow">
  <i class="mdi-action-account-balance-wallet"></i>
  <span>Banks</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/maintenance/content' ? 'active' : ''}}
">
<a href="{{route("content.index")}}" class="waves-yellow">
  <i class="mdi-content-content-paste"></i>
  <span>Contract Content</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/maintenance/businesstypes' ? 'active' : ''}}
">
<a href="{{route("businesstypes.index")}}" class="waves-yellow">
  <i class="mdi-action-wallet-travel"></i>
  <span>Business Type</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/maintenance/requirements' ? 'active' : ''}}
">
<a href="{{route("requirements.index")}}" class="waves-yellow">
  <i class="mdi-file-folder-open"></i>
  <span>Requirements</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/maintenance/repr-positions' ? 'active' : ''}}
">
<a href="{{route("repr-positions.index")}}" class="waves-yellow">
  <i class="mdi-social-person-outline"></i>
  <span>Representative Position</span>
</a>
</li>
</ul>
</li>
<!--END OF MAINTENANCE-->

<!--TRANSACTIONS-->
<li class="{{strpos(Request::path(),'transaction') ? 'active' : ''}}" >
  <a href="javascript:void(0);" class="menu-toggle waves-yellow">
    <i class="mdi-action-swap-horiz"></i>
    <span>Transactions</span>
  </a>
  <ul class="ml-menu">
    <li class="
    {{Request::path() == 'admin/transaction/registration' ? 'active' : ''}}
    ">
    <a href="{{ route('registration.index')}}" class="waves-yellow">
      <i class="mdi-action-assignment-ind"></i>
      <span>Registration</span>
    </a>
  </li>
  <li class="
  {{strpos(Request::path(),'/transaction/registrationApproval') ? 'active' : ''}}
  ">
  <a href="{{ route('registrationApproval.index')}}" class="waves-yellow">
    <i class="mdi-action-assignment-turned-in"></i>
    <span>Registration Approval</span>
  </a>
</li>


<li class="
{{strpos(Request::path(),'transaction/unitRequests') ? 'active' : ''}}
">
<a href="{{route('unitRequests.index')}}" class="waves-yellow">
  <i class="mdi-action-assignment-ind"></i>
  <span>Unit Requests</span>
</a>
</li>

<li class="
{{strpos(Request::path(),'transaction/offersheets') ? 'active' : ''}}
">
<a href="{{route('offersheets.index')}}" class="waves-yellow">
  <i class="mdi-image-switch-camera"></i>
  <span>Offer Sheets</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/transaction/reservationFeeCollection' ? 'active' : ''}}
">
<a href="{{route('reservationFeeCollection.index')}}" class="waves-yellow">
  <i class="mdi-maps-local-atm"></i>
  <span>Reservation Fee Collection</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/transaction/requirementAssigning' ? 'active' : ''}}
{{Request::path() == 'admin/transaction/requirementValidation' ? 'active' : ''}}
">
<a href="javascript:void(0);" class="menu-toggle waves-yellow">
  <i class="mdi-file-folder-open"></i>
  <span>Requirements</span>
</a>
<ul class="ml-menu">
  <li class="
  {{Request::path() == 'admin/transaction/requirementAssigning' ? 'active' : ''}}

  ">
  <a href="{{route('requirementAssigning.index')}}" class=" waves-yellow">
    <i class="mdi-action-thumbs-up-down"></i>
    <span>Requirement Assigning</span>
  </a>
</li>
<li class="
{{Request::path() == 'admin/transaction/requirementValidation' ? 'active' : ''}}
">
<a href="{{route('requirementValidation.index')}}" class="waves-yellow">
  <i class="mdi-content-inbox"></i>
  <span>Requirement Validation</span>
</a>
</li>
</ul>
</li>
<li class="
{{strpos(Request::path(),'transaction/contract') ? 'active' : ''}}
">
<a href="javascript:void(0);" class="menu-toggle waves-yellow">
  <i class="mdi-action-assignment"></i>
  <span>Contracts</span>
</a>
<ul class="ml-menu">
  <li class="
  {{Request::path() == 'admin/transaction/contract-create' ? 'active' : ''}}
  ">
  <a href="{{route("contract-create.index")}}" class="waves-yellow">
    <span>New Contract</span>
  </a>
</li>

<li class="
{{Request::path() == 'admin/transaction/contract' ? 'active' : ''}}
{{strpos(Request::path(),'post-dated-checks') ? 'active' : ''}}

">
<a href="{{route("contractList.index")}}" class="waves-yellow">
  <span>Contract List</span>
</a>
</li>

<li class="
{{Request::path() == 'tenant/transaction/contract' ? 'active' : ''}}
{{strpos(Request::path(),'tenant/transaction/contract') ? 'active' : ''}}
">
<a href="{{route('contract.index')}}" class="waves-yellow">
  <span>View Contract</span>
</a>
</li>

<li>
  <a href="/extendTable" class="waves-yellow">
    <span>Extension and Renewal</span>
  </a>
</li>

<li>
  <a href="/terminateTable" class="waves-yellow">
    <span>Contract Termination</span>
  </a>
</li>
<li>
  <a href="/addammend" class="waves-yellow">
    <span>Addendum and Ammendment</span>
  </a>
</li>
</ul>
</li>
<li class="
{{Request::path() == 'admin/transaction/pdcCollection' ? 'active' : ''}}
">
<a href="{{route('pdcCollection.index')}}" class="waves-yellow">
  <i class="mdi-maps-local-atm"></i>
  <span>PDC Collection</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/transaction/pdcValidation' ? 'active' : ''}}
">
<a href="{{route('pdcValidation.index')}}" class="waves-yellow">
  <i class="mdi-maps-local-atm"></i>
  <span>PDC Validation</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/transaction/move-in' ? 'active' : ''}}

">
<a href="{{route('move-in.index')}}" class="waves-yellow">
  <i class="mdi-action-exit-to-app"></i>
  <span>Move In</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/transaction/collection' ? 'active' : ''}}
">
<a href="javascript:void(0);" class="menu-toggle waves-yellow">
  <i class="mdi-action-payment"></i>
  <span>Billing and Collection</span>
</a>
<ul class="ml-menu">
  <li>
    <a href="/billingTable" class="waves-yellow">
      <span>Billing</span>
    </a>
  </li>

  <li class="
  {{Request::path() == 'admin/transaction/collection' ? 'active' : ''}}
  ">
  <a href="{{route('collection.index')}}" class="waves-yellow">
    <span>Collection</span>
  </a>
</li>
</ul>
</li>
</ul>
</li>
<!--END OF TRANSACTIONS-->

<!--REPORTS-->
<li class="{{strpos(Request::path(),'report') ? 'active' : ''}}">
  <a href="javascript:void(0);" class="menu-toggle waves-yellow">
    <i class="mdi-action-assessment"></i>
    <span>Reports</span>
  </a>
  <ul class="ml-menu">
    <li class="
    {{Request::path() == 'admin/report/moveIn' ? 'active' : ''}}

    ">
    <a href="{{route('moveInReport.index')}}" class="waves-yellow">
      <span>Move In</span>
    </a>
  </li>
  <li class="
  {{Request::path() == 'admin/report/collection' ? 'active' : ''}}

  ">
  <a href="{{route('collectionReport.index')}}" class="waves-yellow">
    <span>Collection</span>
  </a>
</li>
<li class="
{{Request::path() == 'admin/report/billing' ? 'active' : ''}}

">
<a href="{{route('billingReport.index')}}" class="waves-yellow">
  <span>Billing</span>
</a>
</li>
</ul>
</li>
<!--END OF REPORTS-->

<!--QUERIES-->
<li class="{{strpos(Request::path(),'query') ? 'active' : ''}}">
  <a href="javascript:void(0);" class="menu-toggle">
    <i class="mdi-action-find-in-page"></i>
    <span>Queries</span>
  </a>
  <ul class="ml-menu">
    <li class="
    {{Request::path() == 'admin/query/registrationQuery' ? 'active' : ''}}
    ">
    <a href="{{route('registrationQuery.index')}}" class="waves-yellow">
      <span>Registration</span>
    </a>
  </li>
  <li class="
  {{Request::path() == 'admin/query/offerSheetQuery' ? 'active' : ''}}
  ">
  <a href="{{route('offerSheetQuery.index')}}" class="waves-yellow">
    <span>Offer Sheet</span>
  </a>
</li>
<li class="
{{Request::path() == 'admin/query/delinquentQuery' ? 'active' : ''}}
">
<a href="{{route('delinquentQuery.index')}}" class="waves-yellow">
  <span>Delinquent Tenants</span>
</a>
</li>
<li class="
{{Request::path() == 'admin/query/tenant' ? 'active' : ''}}
">
<a href="{{route('tenantQuery.index')}}" class="waves-yellow">
  <span>Tenants</span>
</a>
</li>
</ul>
</li>
<!--END OF QUERIES-->

<!--Utilities-->
<li>
  <a href="{!! route('utilities.index') !!}" >
    <i class="mdi-image-tune"></i>
    <span>Utilities</span>
  </a>
</li>
<!--END OF UTILITIES-->
<li>
  <a href="{!! route('users.index') !!}" >
    <i class="mdi-image-tune"></i>
    <span>User Accounts</span>
  </a>
</li>

</aside>

<!-- #END# Left Sidebar -->
</section>

<section class="content">
  <div class="flash-message">
    @foreach (['red', 'green'] as $color)
    @if(Session::has($color))
    <p class="alert bg-{{ $color }}">{{ Session::get($color) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @endforeach
  </div> <!-- end .flash-message -->

  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header align-center">
          @yield('breadcrumbs')
        </div>
        @yield('content')
      </div>
    </div>
  </div>
</section>
{!!Html::script("plugins/jquery/jquery.min.js")!!}
{!!Html::script("plugins/jquery-datatable/jquery.dataTables.min.js")!!}
{!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js")!!}
@yield('scripts')
{!!Html::script("plugins/jquery-steps/jquery.steps.min.js")!!}
{!!Html::script("plugins/jquery-validation/jquery.validate.min.js")!!}
{!!Html::script("plugins/bootstrap/js/bootstrap.min.js")!!}
{!!Html::script('plugins/jquery/parsley.min.js')!!}
{!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.min.js')!!}
{!!Html::script('plugins/node-waves/waves.min.js')!!}
{!!Html::script('js/pages/forms/advanced-form-elements.min.js')!!}
{!!Html::script('js/notify/notify.min.js')!!}
{!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")!!}
{!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
{!!Html::script("plugins/pace-js/pace.min.js")!!}
{!!Html::script('js/admin.min.js')!!}
{!!Html::script('custom/coreLayoutAjax.js')!!}
<script type="text/javascript">
  readNotifUrl="{{route('custom.readNotification')}}"
</script>>

</body>

</html>