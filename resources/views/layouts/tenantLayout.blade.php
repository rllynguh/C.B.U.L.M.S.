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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {!!Html::style("plugins/DataTables/datatables.min.css")!!}
    {!!Html::style("plugins/node-waves/waves.min.css")!!}
    {!!Html::style("plugins/animate-css/animate.min.css")!!}
    {!!Html::style("plugins/waitMe/waitMe.min.css")!!}
    {!!Html::style("plugins/jquery-ui-1.12.1/jquery-ui.min.css")!!}
    {!!Html::style("plugins/bootstrap3-editable/bootstrap3-editable/css/bootstrap-editable.css")!!}
    {!!Html::style("css/parsleyStyle.min.css")!!}
    {!!Html::style("css/tenant/tenant.css")!!}
    @yield('styles')
    <body class="theme-blue">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-black">
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
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        @include('partials.tenant._navbar')
        <section class="content">
            <div class="container-fluid">
                <div class="row cleafix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class = "card" id = "appa">
                            <div class="header bg-red">
                                @yield('breadcrumbs')
                            </div>
                            <div class ="body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.tenant._withdrawModal')
<script src="{{ asset('js/app.js') }}"></script>
{!!Html::script("plugins/bootstrap-select/js/bootstrap-select.min.js")!!}
{!!Html::script('plugins/node-waves/waves.min.js')!!}
{!!Html::script("plugins/DataTables/datatables.min.js")!!}
{!!Html::script("plugins/jquery-ui-1.12.1/jquery-ui.min.js")!!}
{!!Html::script("plugins/jquery-steps/jquery.steps.min.js")!!}
{!!Html::script("plugins/jquery-validation/jquery.validate.min.js")!!}
{!!Html::script('plugins/jquery/parsley.min.js')!!}
{!!Html::script("plugins/jquery-mask/jquery.mask.min.js")!!}
{!!Html::script('js/pages/forms/advanced-form-elements.min.js')!!}
{!!Html::script('js/notify/notify.min.js')!!}
{!!Html::script("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js")!!}
{!!Html::script("plugins/pace-js/pace.min.js")!!}
{!!Html::script("plugins/waitMe/waitMe.min.js")!!}
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