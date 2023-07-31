<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <title>Login Systeams</title>
</head>
<body style="width: 100%; height: 100vh; padding: 0px; margin: 0;">
    <form action=" {{ route('loginpost') }}" method="post" class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
        @csrf

        @if (Session::has('recordsucces'))
            <div id="recordsucces" class="alert alert-success" role="alert">
                {{ Session::get("recordsucces") }}
            </div>
        @endif

        @if (Session::has('logoutsuccess'))
            <div id="logoutsuccess" class="alert alert-success" role="alert">
                {{ Session::get("logoutsuccess") }}
            </div>
        @endif        
        @if (Session::has('errorhome'))
            <div id="errorhome" class="alert alert-danger" role="alert">
                {{ Session::get("errorhome") }}
            </div>
        @endif

    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="container-fluid d-flex justify-content-center w-100 row flex-column align-items-center">
            <div class="d-flex flex-column col-sm-12 col-md-6 col-lg-6 col-xl-3 row align-items-center p-5 border border-dark">
                <p class="text-center col-10 title-login">User Login</p>
                <div class="col-11">Nickname</div>
                <input id="inputnickname" type="text" class="form-label col-10 mt-1 p-1" name="loginnickname" value="{{ old('loginnickname') }}">
                @if (Session::has('lnicknameerror'))
                                <div id="errornickname" class="col-10 m-0 p-0" style="font-size: 11px; color: red;">{{ Session::get("lnicknameerror") }}</div>
                @endif
                <div class="col-11 mt-1">Password</div>
                <input id="inputpassword" type="password" class="form-label col-10 p-1" name="loginpassword">
                @if (Session::has('lpassworderror'))
                                <div id="errorpassword2" class="col-10 mb-2 p-0" style="font-size: 11px; color: red;">{{ Session::get("lpassworderror") }}</div>
                @endif
                <button class="btn btn-black bg-dark text-white w-50 mt-1">Login</button>
                <p class="mt-2 col-12 text-center" style="font-size: 13px;">Don't have an account? <a href="{{ route('record') }}"><span>You can register.</span></a></p>
            </div>
            @if (Session::has('errornickname2'))
            <div class="alert alert-danger w-25 mt-3" id="errornickname2">
                {{ Session::get('errornickname2') }}
            </div>
            @endif
            @if (Session::has('errorpassword'))
            <div class="alert alert-danger w-25 mt-3" id="errorpassword">
                {{ Session::get('errorpassword') }}
            </div>
            @endif
        </div>
    </div>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
    var inputnickname = document.getElementById('inputnickname');
    var inputpassword = document.getElementById('inputpassword');

    inputnickname.addEventListener('focus', function() {
        var errornickname = document.getElementById('errornickname');
        errornickname.style.display = 'none';
    });

    inputpassword.addEventListener('focus', function() {
        var errorpassword2 = document.getElementById('errorpassword2');
        errorpassword2.style.display = 'none';
    });
    });
    
    setTimeout(() => {
            var errornickname2 = document.getElementById('errornickname2');
            errornickname2.remove();
        }, 3000);
    setTimeout(() => {
            var errorpassword = document.getElementById('errorpassword');
            errorpassword.remove();
        }, 3000);    
    setTimeout(() => {
            var recordsucces = document.getElementById('recordsucces');
            recordsucces.remove();
    }, 3000);

    setTimeout(() => {
            var logoutsuccess = document.getElementById('logoutsuccess');
            logoutsuccess.remove();
    }, 3000);

    setTimeout(() => {
            var errorhome = document.getElementById('errorhome');
            errorhome.remove();
    }, 3000);
    </script>
</body>
</html>