<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - Login Cover Page</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset('admins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admins/assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admins/assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('admins/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admins/assets/css/forms/switches.css')}}">
</head>

<body class="form">
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Sign In To<a href="#"><span class="brand-name"> Blog Chat</span></a></h1>
                    <form class="text-left" method="post" action="{{route('admin.login')}}">
                        @csrf
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <i data-feather="user"></i>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <i data-feather="lock"></i>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                                    <p class="d-inline-block">Show Password</p>
                                    <label class="switch s-primary">
                                        <input type="checkbox" id="toggle-password" class="d-none">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">Log In</button>
                                </div>

                            </div>

                            <div class="field-wrapper text-center keep-logged-in">
                                <div class="n-chk new-checkbox checkbox-outline-primary">
                                    <label class="new-control new-checkbox checkbox-outline-primary">
                                        <input type="checkbox" class="new-control-input" name="remember">
                                        <span class="new-control-indicator"></span>Keep me logged in
                                    </label>
                                </div>
                            </div>

                        </div>
                    </form>
                    <p class="terms-conditions">© {{now()->format('Y')}} All Rights Reserved. <a href="">Blog Chat</a> is a product of Q8Intouch.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('admins/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('admins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('admins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('admins/assets/js/authentication/form-1.js')}}"></script>
<script src="{{asset('admins/plugins/font-icons/feather/feather.min.js')}}"></script>

<script>
    feather.replace()
</script>
</body>
</html>
