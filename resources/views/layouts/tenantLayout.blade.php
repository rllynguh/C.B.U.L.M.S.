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
  {!!Html::style("plugins/node-waves/waves.css")!!}
  {!!Html::style("plugins/animate-css/animate.min.css")!!}
  {!!Html::style("plugins/waitMe/waitMe.min.css")!!}
  {!!Html::style("lib/jquery-ui-1.12.1/jquery-ui.min.css")!!}
  {!!Html::style("css/parsleyStyle.css")!!}
  {!!Html::style("css/themes/all-themes.css")!!}
  {!!Html::style("plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css")!!}
  {!!Html::style("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css")!!}
  
  <!--!Html::style("plugins/materialize-css/css/style.min.css")!!}
-->
  @yield('styles')
</head>
<body>
  <nav class="navbar is-transparent">
  <div class="navbar-brand">
    <a class="navbar-item" href="http://bulma.io">
      <img src="http://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
    </a>

    <a class="navbar-item is-hidden-desktop" href="https://github.com/jgthms/bulma" target="_blank">
      <span class="icon" style="color: #333;">
        <i class="fa fa-lg fa-github"></i>
      </span>
    </a>

    <a class="navbar-item is-hidden-desktop" href="https://twitter.com/jgthms" target="_blank">
      <span class="icon" style="color: #55acee;">
        <i class="fa fa-lg fa-twitter"></i>
      </span>
    </a>

    <div class="navbar-burger burger" data-target="navMenuTransparentExample">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="navMenuTransparentExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="{{route('tenant.home')}}">Home</a>
      <a class="navbar-item" href="{{route('tenant.home')}}">Profiles</a>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link  is-active ">
          Transactions
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item" href="{{route('tenant.home')}}">Home</a>
          <a class = "navbar-item" href="{{route('offerSheetApproval.index')}}">Offer Sheet Approval</a>
          <a class = "navbar-item" href="{{route('registrationForfeit.index')}}">Registration Forfeit</a>
          <a class = "navbar-item" href="{{route('contract.index')}}">View Unaccepted Contracts</a>
          <hr class="navbar-divider">
          <a class = "navbar-item" href="{{route('tenant.contractView')}}">Manage Ongoing Contracts</a>
          <a class = "navbar-item" href="{{route('tenant.requestUnit')}}">Request New Units</a>
          <a class = "navbar-item" href="{{route('tenant.test')}}">Merge units</a>
          <a class = "navbar-item" href="{{route('tenant.terminateContract')}}">Terminate Contract</a>          
          <hr class="navbar-divider">
        </div>
      </div>
    <a class = "navbar-item" href="#services">Documents</a> 
    <a class = "navbar-item" href="#our-team">Statement of Account</a> 
    <a class = "navbar-item" href="#clients">Notifications</a>
    </div>

    <div class="navbar-end">
      <a class="navbar-item is-hidden-desktop-only" href="https://github.com/jgthms/bulma" target="_blank">
        <span class="icon" style="color: #333;">
          <i class="fa fa-lg fa-github"></i>
        </span>
      </a>
      <a class="navbar-item is-hidden-desktop-only" href="https://twitter.com/jgthms" target="_blank">
        <span class="icon" style="color: #55acee;">
          <i class="fa fa-lg fa-twitter"></i>
        </span>
      </a>
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            <a class="button is-primary" href="https://github.com/jgthms/bulma/archive/0.5.3.zip">
              <span class="icon">
                <i class="fa fa-download"></i>
              </span>
              <span>Download</span>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</nav>


@yield('content')
  <script src="{{ asset('js/app.js') }}"></script>
  {!!Html::script("plugins/DataTables/datatables.min.js")!!}
  {!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js")!!}
  {!!Html::script("lib/jquery-ui-1.12.1/jquery-ui.min.js")!!} 
  {!!Html::script("js/pages/forms/form-wizard.js")!!}
  {!!Html::script('js/pages/forms/advanced-form-elements.js')!!}
  {!!Html::script('js/pages/cards/basic.js')!!}
  {!!Html::script('js/notify/notify.min.js')!!}
  <!--{!!Html::script('js/admin.js')!!}  -->
  {!!Html::script('js/demo.js')!!} 
  {!!Html::script("plugins/jquery-steps/jquery.steps.js")!!}
  {!!Html::script("plugins/jquery-validation/jquery.validate.js")!!}
  {!!Html::script('plugins/jquery/parsley.min.js')!!}
  {!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.js')!!}
  {!!Html::script('plugins/node-waves/waves.js')!!}
  {!!Html::script("plugins/waitMe/waitMe.min.js")!!}
  {!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.js")!!}
  {!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
  {!!Html::script("plugins/momentjs/moment.js")!!}
  {!!Html::script("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js")!!}
  {!!Html::script("js/tenant/custom.js")!!}

@yield('scripts')
</body>
</html>