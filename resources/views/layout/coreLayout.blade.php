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
  {!!Html::style("plugins/sweetalert/sweetalert.css")!!}
  {!!Html::style("plugins/bootstrap/css/bootstrap.css")!!}
  {!!Html::style("plugins/node-waves/waves.css")!!}
  {!!Html::style("plugins/animate-css/animate.css")!!}
  {!!Html::style("css/style.css")!!}
  {!!Html::style("css/parsleyStyle.css")!!}
  {!!Html::style("css/themes/all-themes.css")!!}
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
                  <a href="{{route('buildingtypes.index')}}" class="waves-yellow">
                    <i class="mdi-hardware-keyboard-arrow-right"></i>
                    <span>Building Type</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('buildings.index')}}" class="waves-yellow">
                    <i class="mdi-hardware-keyboard-arrow-right"></i>
                    <span>Buildings</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('floors.index')}}" class="waves-yellow">
                    <i class="mdi-hardware-keyboard-arrow-right"></i>
                    <span>Floors</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('units.index')}}" class="waves-yellow">
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
                  <a href="{{route('parkareas.index')}}" class="waves-yellow">
                    <i class="mdi-hardware-keyboard-arrow-right"></i>
                    <span>Parking Area</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('parkspaces.index')}}" class="waves-yellow">
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
                  <a href="{{route('marketrates.index')}}" class="waves-yellow">
                    <i class="mdi-hardware-keyboard-arrow-right"></i>
                    <span>Market Rates</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('requirementAssigning.index')}}" class=" waves-yellow">
                    <i class="mdi-navigation-chevron-right"></i>
                    <span>Requirement Assigning</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="{{route("banks.index")}}" class="waves-yellow">
                <i class="mdi-action-account-balance-wallet"></i>
                <span>Banks</span>
              </a>
            </li>
            <li>
              <a href="{{route("businesstypes.index")}}" class="waves-yellow">
                <i class="mdi-action-wallet-travel"></i>
                <span>Business Type</span>
              </a>
            </li>
            <li>
              <a href="{{route("requirements.index")}}" class="waves-yellow">
                <i class="mdi-file-folder-open"></i>
                <span>Requirements</span>
              </a>
            </li>
            <li>
              <a href="{{route("repr-positions.index")}}" class="waves-yellow">
                <i class="mdi-social-person-outline"></i>
                <span>Representative Position</span>
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
              <a href="{{ route('registration.index')}}" class="waves-yellow">
                <i class="mdi-action-assignment-ind"></i>
                <span>Registration</span>
              </a>
            </li>
            <li>
              <a href="{{ route('registrationApproval.index')}}" class="waves-yellow">
                <i class="mdi-action-assignment-turned-in"></i>
                <span>Registration Approval</span>
              </a>
            </li>
            <li>
              <a href="{{route('offersheets.index')}}" class="waves-yellow">
                <i class="mdi-image-switch-camera"></i>
                <span>Offer Sheets</span>
              </a>
            </li>
            <li>
              <a href="{{route('registrationForfeit.index')}}" class=" waves-yellow">
                <i class="mdi-action-delete"></i>
                <span>Registration Forfeit</span>
              </a>
            </li>
            <li>
              <a href="{{route('offerSheetApproval.index')}}" class=" waves-yellow">
                <i class="mdi-action-thumbs-up-down"></i>
                <span>Offer Sheets Approval</span>
              </a>
            </li>
            <li>
              <a href="{{route('reservationFeeCollection.index')}}" class="waves-yellow">
                <i class="mdi-maps-local-atm"></i>
                <span>Reservation Fee Collection</span>
              </a>
            </li>
            <li>
              <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                <i class="mdi-file-folder-open"></i>
                <span>Requirements</span>
              </a>
              <ul class="ml-menu">
                <li>
                  <li>
                    <a href="{{route('requirementAssigning.index')}}" class=" waves-yellow">
                      <i class="mdi-navigation-chevron-right"></i>
                      <span>Requirement Assigning</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="{{route("banks.index")}}" class="waves-yellow">
                  <i class="mdi-action-account-balance-wallet"></i>
                  <span>Banks</span>
                </a>
              </li>
              <li>
                <a href="{{route("businesstypes.index")}}" class="waves-yellow">
                  <i class="mdi-action-wallet-travel"></i>
                  <span>Business Type</span>
                </a>
              </li>
              <li>
                <a href="{{route("requirements.index")}}" class="waves-yellow">
                  <i class="mdi-file-folder-open"></i>
                  <span>Requirements</span>
                </a>
              </li>
              <li>
                <a href="{{route("repr-positions.index")}}" class="waves-yellow">
                  <i class="mdi-social-person-outline"></i>
                  <span>Representative Position</span>
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
                <a href="{{ route('registration.index')}}" class="waves-yellow">
                  <i class="mdi-action-assignment-ind"></i>
                  <span>Registration</span>
                </a>
              </li>
              <li>
                <a href="{{ route('registrationApproval.index')}}" class="waves-yellow">
                  <i class="mdi-action-assignment-turned-in"></i>
                  <span>Registration Approval</span>
                </a>
              </li>
              <li>
                <a href="{{route('offersheets.index')}}" class="waves-yellow">
                  <i class="mdi-image-switch-camera"></i>
                  <span>Offer Sheets</span>
                </a>
              </li>
              <li>
                <a href="{{route('registrationForfeit.index')}}" class=" waves-yellow">
                  <i class="mdi-action-delete"></i>
                  <span>Registration Forfeit</span>
                </a>
              </li>
              <li>
                <a href="{{route('offerSheetApproval.index')}}" class=" waves-yellow">
                  <i class="mdi-action-thumbs-up-down"></i>
                  <span>Offer Sheets Approval</span>
                </a>
              </li>
              <li>
                <a href="{{route('reservationFeeCollection.index')}}" class="waves-yellow">
                  <i class="mdi-maps-local-atm"></i>
                  <span>Reservation Fee Collection</span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                  <i class="mdi-file-folder-open"></i>
                  <span>Requirements</span>
                </a>
                <ul class="ml-menu">
                  <li>
                    <a href="{{route('requirementSubmission.index')}}" class="waves-yellow">
                      <i class="mdi-navigation-chevron-right"></i>
                      <span>Submission of Requirements</span>
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
                  <li>
                    <a href="{{route('requirementValidation.index')}}" class="waves-yellow">
                      <i class="mdi-navigation-chevron-right"></i>
                      <span>Requirement Validation</span>
                    </a>
                  </li>
                </li>
              </ul>
            </li>
            <li>
              <a href="javascript:void(0);" class="menu-toggle waves-yellow">
                <i class="mdi-action-assignment"></i>
                <span>Contracts</span>
              </a>
              <ul class="ml-menu">
                <li>
                  <a href="{{route('requirementSubmission.index')}}" class="waves-yellow">
                    <i class="mdi-navigation-chevron-right"></i>
                    <span>Requirement Submission</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('requirementValidation.index')}}" class="waves-yellow">
                    <i class="mdi-navigation-chevron-right"></i>
                    <span>Requirement Validation</span>
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
                <a href="{{route('move-in.index')}}" class="waves-yellow">
                  <i class="mdi-action-exit-to-app"></i>
                  <span>Move In</span>
                </a>
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
                    <a href="{{route('collection.index')}}" class="waves-yellow">
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
      {!!Html::script('plugins/sweetalert/sweetalert.min.js')!!}
      {!!Html::script('js/pages/forms/advanced-form-elements.js')!!}
      {!!Html::script('js/notify/notify.min.js')!!}
      {!!Html::script("plugins/jquery-datatable/jquery.dataTables.js")!!}
      {!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.js")!!}
      {!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js")!!}
      {!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
      {!!Html::script('js/admin.js')!!}

    </body>

    </html>
