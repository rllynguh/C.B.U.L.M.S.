<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <meta name="description" content="Creative One Page Parallax Template">
  <meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
  <meta name="author" content=""> 
  <title>Majent | Tenant Portal</title> 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  {!!Html::style("lib/DataTables/datatables.css")!!}  
  {!!Html::style("plugins/sweetalert/sweetalert.css")!!}
  {!!Html::style("plugins/bootstrap/css/bootstrap.css")!!}
  {!!Html::style("plugins/node-waves/waves.css")!!}
  {!!Html::style("plugins/animate-css/animate.min.css")!!}
  {!!Html::style("plugins/waitMe/waitMe.min.css")!!}
  {!!Html::style("css/parsleyStyle.css")!!}
  {!!Html::style("css/themes/all-themes.css")!!}
  {!!Html::style("plugins/materialize-css/css/style.min.css")!!}
  @yield('styles')
</head>
<body>
  <header id="navigation"> 
    <div class="navbar navbar-inverse navbar-fixed-top" role="banner"> 
      <div class="container-fluid"> 
        <div class="navbar-header"> 
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
          </button> 
          <a class="navbar-brand" href="index.html"><h1><img src="images/logo.png" alt="logo"></h1></a> 
        </div> 
        <div class="collapse navbar-collapse"> 
          <ul class="nav navbar-nav navbar-right"> 
            <li class="scroll active"><a href="#navigation">Home</a></li> 
            <li class="scroll"><a href="#about-us">Profiles</a></li> 
            <li class="scroll"><a href="#services">Documents</a></li> 
            <li class="scroll"><a href="#our-team">Statement of Account</a></li> 
            <li class="scroll"><a href="#clients">Notifications</a></li>
          
          </ul> 
        </div> 
      </div> 
    </div>
  </header>
@yield('content')
  {!!Html::script("lib/DataTables/datatables.js")!!}
  {!!Html::script("plugins/bootstrap/js/bootstrap.js")!!}
  {!!Html::script("plugins/bootstrap-select/js/bootstrap-select.min.js")!!} 
  {!!Html::script("lib/jquery-ui-1.12.1/jquery-ui.min.js")!!}
  {!!Html::script("js/pages/forms/form-wizard.js")!!}
  {!!Html::script("plugins/jquery-steps/jquery.steps.js")!!}
  {!!Html::script("plugins/jquery-validation/jquery.validate.js")!!}
  {!!Html::script('plugins/jquery/parsley.min.js')!!}
  {!!Html::script('plugins/jquery-slimscroll/jquery.slimscroll.js')!!}
  {!!Html::script('plugins/node-waves/waves.js')!!}
  {!!Html::script('plugins/sweetalert/sweetalert.min.js')!!}
  {!!Html::script('js/pages/cards/basic.js')!!}
  {!!Html::script('js/notify/notify.min.js')!!}
  {!!Html::script("plugins/waitMe/waitMe.min.js")!!}
  {!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.js")!!}
  {!!Html::script("plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js")!!}
  {!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
  {!!Html::script('js/admin.js')!!} 
  {!!Html::script('js/demo.js')!!} 
@yield('scripts')