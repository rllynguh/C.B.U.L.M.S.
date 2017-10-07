<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Log In | Majent CBULMS</title>


    {{Html::style('plugins/bootstrap/css/bootstrap.min.css')}}
    {{Html::style('plugins/node-waves/waves.min.css')}}
    {{Html::style('plugins/animate-css/animate.min.css')}}
    {{Html::style('css/style.min.css')}}
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Majent<b>CBULMS</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                {{Form::open()}}
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="mdi-social-person"></i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="email" placeholder="Username" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="mdi-action-lock"></i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="remember" class="filled-in chk-col-yellow">
                        <label for="remember">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-brown waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="sign-up.html">Register Now!</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="forgot-password.html">Forgot Password?</a>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
    {{Html::script('plugins/jquery/jquery.min.js')}}
    {{Html::script('plugins/bootstrap/js/bootstrap.min.js')}}
    {{Html::script('plugins/node-waves/waves.min.js')}}
    {{Html::script('plugins/jquery-validation/jquery.validate.min.js')}}

</body>

</html>

