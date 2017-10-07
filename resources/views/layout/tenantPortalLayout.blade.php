<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="_token" content="{!! csrf_token() !!}" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, 
  user-scalable=no" name="viewport">
  <title>Majent | Lease Management System</title>
  <link rel="icon" href="images/icon1.ico">
  {!!Html::style("plugins/bootstrap/css/bootstrap.css")!!}
  {!!Html::style("plugins/node-waves/waves.css")!!}
  {!!Html::style("plugins/animate-css/animate.css")!!}
  {!!Html::style("css/style.css")!!}
  {!!Html::style("css/parsleyStyle.css")!!}
  {!!Html::style("css/themes/all-themes.css")!!}
  {!!Html::style("plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css")!!}
  {!!Html::style("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css")!!}
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
              <span class="label-count">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">NOTIFICATIONS</li>
              <li class="body">
                <ul class="menu">
                  <li>
                    Notifs here
                  </li>
                </ul>
              </li>
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
        <li class="header fixed">MAIN NAVIGATION</li>
        <li>
          <a href="/" class=" waves-yellow">
            <i class="mdi-action-home"></i>
            <span>Home</span>
          </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="waves-yellow">
                <i class="mdi-content-block"></i>
                <span>Forfeit Registration</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="waves-yellow">
                <i class="mdi-action-thumbs-up-down"></i>
                <span>Offer Sheet Approval</span>
            </a>
        </li>

         <li>
            <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                <i class="mdi-action-view-module"></i>
                <span>Units</span>
            </a>
            <ul class="ml-menu">
                <li class="javascript:void(0);">
                    <a href="javascript:void(0);" class="waves-yellow">
                        <span>Request Unit</span>
                    </a>
                </li>
                <li class="javascript:void(0);">
                    <a href="javascript:void(0);" class="waves-yellow">
                        <span>Transfer Unit</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                <i class="mdi-action-assignment"></i>
                <span>Contracts</span>
            </a>
            <ul class="ml-menu">
                <li class="javascript:void(0);">
                    <a href="javascript:void(0);" class="waves-yellow">
                        <span>Ammendment</span>
                    </a>
                </li>
                <li class="javascript:void(0);">
                    <a href="javascript:void(0);" class="waves-yellow">
                        <span>Termination Request</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="waves-yellow">
                <i class="mdi-action-receipt"></i>
                <span>Statement of Account</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="waves-yellow">
                <i class="mdi-social-notifications-on"></i>
                <span>Notifications</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="waves-yellow">
                <i class="mdi-action-assignment-ind"></i>
                <span>Profile</span>
            </a>
        </li>
        
<!-- #Menu -->
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
{!!Html::script("plugins/jquery-datatable/jquery.dataTables.js")!!}
{!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js")!!}
@yield('scripts')
{!!Html::script("js/pages/forms/form-wizard.js")!!}
{!!Html::script("plugins/jquery-steps/jquery.steps.js")!!}
{!!Html::script("plugins/jquery-validation/jquery.validate.js")!!}
{!!Html::script("plugins/bootstrap/js/bootstrap.js")!!}
{!!Html::script('plugins/jquery/parsley.min.js')!!}
{!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.js')!!}
{!!Html::script('plugins/node-waves/waves.js')!!}
{!!Html::script('js/pages/forms/advanced-form-elements.js')!!}
{!!Html::script('js/notify/notify.min.js')!!}
{!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.js")!!}
{!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
{!!Html::script('js/admin.js')!!}
{!!Html::script("plugins/momentjs/moment.js")!!}
{!!Html::script("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js")!!}

</body>

</html>
