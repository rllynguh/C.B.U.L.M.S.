<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Majent | Lease Management System</title>
    <link rel="icon" href="images/icon1.ico">
    {!!Html::style("plugins/sweetalert/sweetalert.css")!!}
    {!!Html::style("plugins/bootstrap/css/bootstrap.css")!!}
    {!!Html::style("plugins/node-waves/waves.css")!!}
    {!!Html::style("plugins/animate-css/animate.css")!!}
    {!!Html::style("plugins/morrisjs/morris.css")!!}
    {!!Html::style("css/style.css")!!}
    {!!Html::style("css/parsleyStyle.css")!!}
    {!!Html::style("css/themes/all-themes.css")!!}
    @yield("styles")
</head>

<

<body class="theme-brown">

    <!-- Page Loader -->
    {{--     <div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader pl-size-xl">
            <div class="spinner-layer pl-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div> --}}
<!-- #END# Page Loader -->

<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- #END# Search Bar -->

<!-- Top Bar -->
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
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="mdi-social-notifications"></i>
                        <span class="label-count">7</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <ul class="menu">
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>12 new members joined</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 14 mins ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-cyan">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>4 sales made</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 22 mins ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-red">
                                            <i class="material-icons">delete_forever</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>Nancy Doe</b> deleted account</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 3 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-orange">
                                            <i class="material-icons">mode_edit</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>Nancy</b> changed name</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 2 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-blue-grey">
                                            <i class="material-icons">comment</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>John</b> commented your post</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 4 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">cached</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>John</b> updated status</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 3 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-purple">
                                            <i class="material-icons">settings</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Settings updated</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> Yesterday
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">View All Notifications</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
                <!-- Tasks -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="mdi-content-flag"></i>
                        <span class="label-count">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">TASKS</li>
                        <li class="body">
                            <ul class="menu tasks">
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Footer display issue
                                            <small>32%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Make new buttons
                                            <small>45%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Create new dashboard
                                            <small>54%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Solve transition issue
                                            <small>65%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Answer GitHub questions
                                            <small>92%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">View All Tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Tasks -->
                <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="mdi-navigation-more-vert"></i></a></li>
            </ul>
        </div>
    </div>
</nav>


<!-- #Top Bar -->

<section>
    <!-- Left Sidebar -->

    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image p-l-80">
                {{ HTML::image('images/vcv.jpg') }}
            </div>
            <div class="info-container">
                <div class="name align-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Venmar Vicente</div>
                <div class="email align-center">binmurv@gmail.com</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="mdi-hardware-keyboard-arrow-down" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-social-person pull-left"></i>Profile</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-social-group pull-left"></i>Followers</a></li>
                        <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-action-shopping-cart pull-left"></i>Sales</a></li>
                        <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-action-grade pull-left"></i>Likes</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="javascript:void(0);" class="waves-lime"><i class="mdi-action-input pull-left"></i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- #User Info -->

        <!-- Menu -->
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
                <li>
                    <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                        <i class="mdi-action-settings"></i>
                        <span>Maintenance</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                              <i class="mdi-communication-business"></i>
                              <span>Building</span>
                          </a>
                          <ul class="ml-menu">
                            <li>
                              <a href="{{-- {{route('buildingtype.index')}} --}}" class="waves-yellow">
                                <i class="mdi-hardware-keyboard-arrow-right"></i>
                                <span>Building Type</span>
                            </a>
                        </li>

                        <li>
                          <a href="{{-- {{route('building.index')}} --}}" class="waves-yellow">
                            <i class="mdi-hardware-keyboard-arrow-right"></i>
                            <span>Buildings</span>
                        </a>
                    </li>
                    <li>
                      <a href="{{-- {{route('floor.index')}} --}}" class="waves-yellow">
                        <i class="mdi-hardware-keyboard-arrow-right"></i>
                        <span>Floors</span>
                    </a>
                </li>
                <li>
                  <a href="{{-- {{route('unit.index')}} --}}" class="waves-yellow">
                    <i class="mdi-hardware-keyboard-arrow-right"></i>
                    <span>Units</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle waves-yellow">
          <i class="mdi-maps-directions-car"></i>
          <span>Parking</span>
      </a>
      <ul class="ml-menu">
        <li>
          <a href="{{-- {{route('parkArea.index')}} --}}" class="waves-yellow">
            <i class="mdi-hardware-keyboard-arrow-right"></i>
            <span>Parking Area</span>
        </a>
    </li>

    <li>
      <a href="{{-- {{route('parkSpace.index')}} --}}" class="waves-yellow">
        <i class="mdi-hardware-keyboard-arrow-right"></i>
        <span>Parking Space</span>
    </a>
</li>
</ul>
</li>
<li>
    <a href="javascript:void(0);" class="menu-toggle waves-yellow">
      <i class="mdi-editor-attach-money"></i>
      <span>Rates</span>
  </a>
  <ul class="ml-menu">
    <li>
      <a href="{{-- {{route('marketrate.index')}} --}}" class="waves-yellow">
        <i class="mdi-hardware-keyboard-arrow-right"></i>
        <span>Market Rates</span>
    </a>
</li>

<li>
    <a href="{{-- {{route('parkrate.index')}} --}}" class="waves-yellow">
        <i class="mdi-hardware-keyboard-arrow-right"></i>
        <span>Parking Space Lease Rate</span>
    </a>
</li>
</ul>
</li>
<li>
    <a href="{{-- {{route("bank.index")}} --}}" class="waves-yellow">
        <i class="mdi-action-account-balance-wallet"></i>
        <span>Banks</span>
    </a>
</li>
<li>
    <a href="{{-- {{route("businesstype.index")}} --}}" class="waves-yellow">
        <i class="mdi-social-group"></i>
        <span>Business Type</span>
    </a>
</li>
</ul>
</li>
<!--END OF MAINTENANCE-->

<!--TRANSACTIONS-->
<li>
    <a href="javascript:void(0);" class="menu-toggle waves-yellow">
        <i class="mdi-action-swap-horiz"></i>
        <span>Transactions</span>
    </a>
    <ul class="ml-menu">
        <li>
            <a href="{{-- {!! route('registration.index') !!} --}}" class="waves-yellow">
                <i class="mdi-action-assignment-ind"></i>
                <span>Registration</span>
            </a>
        </li>
        <li>
            <a href="javascript:void;" class="menu-toggle waves-yellow">
                <i class="mdi-action-thumbs-up-down"></i>
                <span>Request Approval</span>
            </a>
            <ul class="ml-menu">
              <li>
                  <a href="/requestTable" class="waves-yellow">
                      <i class="mdi-hardware-keyboard-arrow-right"></i>
                      <span>Registration Request</span>
                  </a>
              </li>
              <li>
                  <a href="/moveRequestTable" class="waves-yellow">
                      <i class="mdi-hardware-keyboard-arrow-right"></i>
                      <span>Move In / Out Request</span>
                  </a>
              </li>
          </ul>
      </li>
      <li>
          <a href="/submissionTable" class="waves-yellow">
            <i class="mdi-content-inbox"></i>
            <span>Submission of Requirements</span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="menu-toggle waves-yellow">
          <i class="mdi-action-assignment"></i>
          <span>Contracts</span>
      </a>
      <ul class="ml-menu">
        <li>
            <a href="/contractCreate" class="waves-yellow">
              <i class="mdi-hardware-keyboard-arrow-right"></i>
              <span>New Contract</span>
          </a>
      </li>

      <li>
          <a href="/extendTable" class="waves-yellow">
            <i class="mdi-hardware-keyboard-arrow-right"></i>
            <span>Extension and Renewal</span>
        </a>
    </li>

    <li>
      <a href="/terminateTable" class="waves-yellow">
        <i class="mdi-hardware-keyboard-arrow-right"></i>
        <span>Contract Termination</span>
    </a>
</li>
<li>
    <a href="/addammend" class="waves-yellow">
        <i class="mdi-hardware-keyboard-arrow-right"></i>
        <span>Addendum and Ammendment</span>
    </a>
</li>
</ul>
</li>
<li>
    <a href="javascript:void(0);" class="menu-toggle waves-yellow">
      <i class="mdi-action-payment"></i>
      <span>Billing and Collection</span>
  </a>
  <ul class="ml-menu">
    <li>
        <a href="/billingTable" class="waves-yellow">
          <i class="mdi-hardware-keyboard-arrow-right"></i>
          <span>Billing</span>
      </a>
  </li>

  <li>
      <a href="/collectionTable" class="waves-yellow">
        <i class="mdi-hardware-keyboard-arrow-right"></i>
        <span>Collection</span>
    </a>
</li>
</ul>
</li>
</ul>
</li>
<!--END OF TRANSACTIONS-->

<!--REPORTS-->
<li>
    <a href="javascript:void(0);" class="menu-toggle waves-yellow">
        <i class="mdi-action-assessment"></i>
        <span>Reports</span>
    </a>
    <ul class="ml-menu">
      <li>
          <a href="{{-- {{route('registrationReport.index')}} --}}">Registration</a>
      </li>
  </ul>
</li>
<!--END OF REPORTS-->

<!--QUERIES-->
<li>
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="mdi-action-find-in-page"></i>
        <span>Queries</span>
    </a>
    <ul class="ml-menu">
    </ul>
</li>
<!--END OF QUERIES-->

<!--Utilities-->
<li>
    <a href="{{-- {!! route('utilities.index') !!} --}}" >
        <i class="mdi-image-tune"></i>
        <span>Utilities</span>
    </a>
</li>
<!--END OF UTILITIES-->


<!-- #Menu -->
</aside>

<!-- #END# Left Sidebar -->
</section>

<section class="content">
  @yield('content')
</section>
{!!Html::script("plugins/jquery/jquery.min.js")!!}
@yield('scripts')
{!!Html::script("js/pages/forms/form-wizard.js")!!}
{!!Html::script("plugins/jquery-steps/jquery.steps.js")!!}
{!!Html::script("plugins/jquery-validation/jquery.validate.js")!!}
{!!Html::script("plugins/bootstrap/js/bootstrap.js")!!}
{!!Html::script('plugins/jquery/parsley.min.js')!!}
{!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.js')!!}
{!!Html::script('plugins/node-waves/waves.js')!!}
{!!Html::script('plugins/jquery-countto/jquery.countTo.js')!!}
{!!Html::script('plugins/raphael/raphael.min.js')!!}
{!!Html::script('plugins/morrisjs/morris.js')!!}
{!!Html::script('plugins/chartjs/Chart.bundle.js')!!}
{!!Html::script('plugins/jquery-sparkline/jquery.sparkline.js')!!}
{!!Html::script('js/admin.js')!!}
{!!Html::script('js/demo.js')!!}
{!!Html::script('plugins/sweetalert/sweetalert.min.js')!!}
{!!Html::script('js/pages/ui/notifications.js')!!}
{!!Html::script('js/notify/notify.min.js')!!}
</body>

</html>
