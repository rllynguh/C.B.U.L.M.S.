<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative One Page Parallax Template">
    <meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" />
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Majent | Tenant Portal</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {!!Html::style("plugins/DataTables/datatables.min.css")!!}
    {!!Html::style("plugins/node-waves/waves.min.css")!!}
    {!!Html::style("plugins/animate-css/animate.min.css")!!}
    {!!Html::style("plugins/waitMe/waitMe.min.css")!!}
    {!!Html::style("plugins/jquery-ui-1.12.1/jquery-ui.min.css")!!}
    {!!Html::style("plugins/bootstrap3-editable/bootstrap3-editable/css/bootstrap-editable.css")!!}
    {!!Html::style("css/parsleyStyle.min.css")!!}
    {!!Html::style("css/themes/all-themes.min.css")!!}
    {!!Html::style("plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css")!!}
    {!!Html::style("css/tenant/tenant.css")!!}
    
    @yield('styles')
  </head>
  <body>
    <div  class="container-fluid" id = "wrapper">
      <div class = "overlay">
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
          <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
              <div class="row">
                <a href="{{route('tenant.home')}}">
                  Majent Tenant Portal
                </a>
              </div>
            </li>
              <li></li>
              <li>
              <a href="{{route('tenant.home')}}"><i class="fa fa-fw fa-home"></i> Home</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-fw fa-credit-card"></i>  Statement of Account</a>
            </li>
            <!--<li>
              <a href="#"><i class="fa fa-fw fa-file-o"></i> Documents</a>
            </li>-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Transactions <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">Transactions</li>
                <li><a href="{{route('offerSheetApproval.index')}}">Offer Sheet Approval</a></li>
                <li><a href="{{route('registrationForfeit.index')}}">Registration Forfeit</a></li>
                <li><a href="{{route('contract.index')}}">View Current Contract Details</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{route('tenant.contractView')}}">Manage Ongoing Contracts</a></li>
                <li><a href="{{route('tenant.requestUnit')}}">Request New Units</a></li>
                <li><a href="{{route('tenant.terminateContract')}}">Terminate Contract</a></li>
              </ul>
            </li>
            
            @auth
            <li class = "dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i>{{Auth::user()->first_name }} {{Auth::user()->last_name}}<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a  id = "notification" href="{{route('account.notification.index')}}" > <i class="fa fa-fw fa-file-o"></i> Notifications</a></li>
                <li><a href="{{route('tenant.account.index')}}"><i class="fa fa-fw fa-cog"></i> Manage Account</a></li>
                <li><a onclick="showWithdrawModal()" id = 'btnShowWithdrawModal' data-toggle="modal" href='#withdrawModal'><i class="fa fa-fw fa-money"></i> Balance:
                  <span class="label label-primary" id = 'balance'></span>
                </a></li>
                <li><a href="{{route('account.notification.index')}}"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            @else
            <a href="#"><i class="fa fa-fw fa-sign-in"></i> Login</a>
            @endauth
          </ul>
        </nav>
      </div>
      <div id="page-content-wrapper">
        <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
        <span class="hamb-top"></span>
        <span class="hamb-middle"></span>
        <span class="hamb-bottom"></span>
        </button>
        <div class="container">
          <div class="row">
            <div class="col-lg-12 ">
              <div id = "appa">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('partials.tenant._withdrawModal')
    <!--{!!Html::script('js/admin.js')!!}  -->
    <script src="{{ asset('js/app.js') }}"></script>
    {!!Html::script("js/pages/forms/form-wizard.min.js")!!}
    
    {!!Html::script("plugins/DataTables/datatables.min.js")!!}
    {!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js")!!}
    {!!Html::script("plugins/jquery-ui-1.12.1/jquery-ui.min.js")!!}
    {!!Html::script('js/pages/forms/advanced-form-elements.min.js')!!}
    {!!Html::script('js/pages/cards/basic.js')!!}
    {!!Html::script('js/notify/notify.min.js')!!}
    {!!Html::script('js/demo.js')!!}
    {!!Html::script("plugins/jquery-steps/jquery.steps.min.js")!!}
    {!!Html::script("plugins/jquery-validation/jquery.validate.min.js")!!}
    {!!Html::script('plugins/jquery/parsley.min.js')!!}
    {!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.min.js')!!}
    {!!Html::script('plugins/node-waves/waves.min.js')!!}
    {!!Html::script("plugins/waitMe/waitMe.min.js")!!}
    {!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")!!}
    {!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
    {!!Html::script("plugins/bootstrap3-editable/bootstrap3-editable/js/bootstrap-editable.min.js")!!}
    <script type="text/javascript">
    var urlNotificationCount = "{{route("custom.getNotificationCount")}}";
    urlfloor="{{route("buildings.storefloor")}}";
    urlbtype="{{route("custom.getBuildingType")}}";
    urlprov="{{route("custom.getProvince")}}";
    urlprice="{{route("buildings.storePrice")}}";
    buil_type_url="{{route("custom.getBuildingType")}}";
    prov_url="{{route("custom.getProvince")}}";
    posi_url="{{route("custom.getPosition")}}";
    floor_url="{{route("custom.getFloor")}}";
    range_url="{{route("custom.getRange")}}";
    url_balance= "{{route("custom.getBalance")}}";
    var url_balance_store='{{route('custom.postBalance')}}';
    </script>
    {!!Html::script("js/tenant/custom.js")!!}
    @yield('scripts')
  </body>
</html>