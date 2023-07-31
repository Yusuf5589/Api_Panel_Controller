<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <title>Record Systeams</title>
</head>
<body style="width: 100%; height: 100vh; padding: 0px; margin: 0;">


    
    <form action="{{ route("recordpost") }}" method="post" class="container-fluid d-flex justify-content-center h-100 align-items-center" autocomplete="off">
     @csrf
        
    <div class="container-fluid d-flex justify-content-center h-100 align-items-center flex-column">
        <div class="container-fluid d-flex justify-content-center w-100 row">
            <div class="d-flex flex-column col-sm-12 col-md-6 col-lg-6 col-xl-4 row align-items-center p-5 border border-dark">
                <p class="text-center col-10 title-login">Register</p>
                <div class="col-12 col-xl-10 row d-flex justify-content-center mt-0 p-0">
                    <div class="d-flex col-12 mt-0 p-0 justify-content-center">
                        <div class="col-6">
                            <div class="col-12 col-xl-10 m-0 p-0 mt-2">Name</div>
                            <input id="inputname" type="text" class="col-12 label mt-1 p-1" name="name" value="{{ Session::get("namevalue") }}">
                            @if (Session::has('nameerror'))
                                <div id="errorname" class="mt-1" style="font-size: 11px; color: red;">{{ Session::get("nameerror") }}</div>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="col-12 col-xl-10 m-0 p-0 mt-2">Surname</div>
                            <input id="inputsurname" type="text" name="surname" class="col-12 label mt-1 p-1" value="{{ Session::get("surnamevalue") }}">
                            @if (Session::has('surnameerror'))
                                <div id="errorsurname" class="mt-1" style="font-size: 11px; color: red;">{{ Session::get("surnameerror") }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-10 m-0 p-0 mt-2">Nickname</div>
                <input id="inputnickname" type="text" name="nickname" class="label col-12 col-xl-10 mt-1 p-1" value="{{ Session::get("nicknamevalue") }}">
                @if (Session::has('nicknameerror'))
                        <div id="errornickname" class="mt-1 col-12 col-xl-10 p-0" style="font-size: 11px; color: red;">{{ Session::get("nicknameerror") }}</div>
                @endif
                <div class="col-12 col-xl-10 m-0 p-0 mt-2">Password</div>
                <input id="inputpassword" type="password" name="password" class="form-label col-12 col-xl-10 mt-1 p-1" value="{{ Session::get("passwordvalue") }}">
                @if (Session::has('passworderror'))
                        <div id="errorpassword" class="col-12 col-xl-10 p-0 mb-2" style="font-size: 11px; color: red;">{{ Session::get("passworderror") }}</div>
                @endif
                <div class="col-12 col-xl-10 m-0 p-0">Password Again</div>
                <input id="inputpasswordagain" type="password" name="passwordagain" class="form-label col-12 col-xl-10 mt-1 p-1" value="{{ Session::get("passwordvalue") }}">
                @if (Session::has('passwordagainerror'))
                        <div id="errorpasswordagain" class="col-12 col-xl-10 p-0 mb-2" style="font-size: 11px; color: red;">{{ Session::get("passwordagainerror") }}</div>
                @endif
                <button class="btn btn-black bg-dark text-white w-50 mt-1">Register</button>
                <p class="mt-2 col-12 text-center" style="font-size: 13px;"><a href="{{ route('login') }}"><span>Login.</span></a></p>
            </div>
            @if (Session::has('successrecord'))
            <div class="w-100 mt-3 row d-flex justify-content-center">
                <div class="alert alert-success col-sm-12 col-md-6 col-lg-6 col-xl-4" id="successrecord">
                    {{ Session::get('successrecord') }}
                </div>
            </div>
            @endif
            @if (Session::has('errornickname2'))
            <div class="w-100 mt-3 row d-flex justify-content-center">
                <div class="alert alert-danger col-sm-12 col-md-6 col-lg-6 col-xl-4" id="errornickname2">
                    {{ Session::get('errornickname2') }}
                </div>
            </div>
            @endif
        </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
    var inputname = document.getElementById('inputname');
    var inputsurname = document.getElementById('inputsurname');
    var inputnickname = document.getElementById('inputnickname');
    var inputpassword = document.getElementById('inputpassword');
    var inputpasswordagain = document.getElementById('inputpasswordagain');

    inputname.addEventListener('focus', function() {
        var errorname = document.getElementById('errorname');
        errorname.style.display = 'none';
    });

    inputsurname.addEventListener('focus', function() {
        var errorsurname = document.getElementById('errorsurname');
        errorsurname.style.display = 'none';
    });

    inputnickname.addEventListener('focus', function() {
        var errornickname = document.getElementById('errornickname');
        errornickname.style.display = 'none';
    });

    inputpassword.addEventListener('focus', function() {
        var errorpassword = document.getElementById('errorpassword');
        errorpassword.style.display = 'none';
    });

    inputpasswordagain.addEventListener('focus', function() {
        var errorpasswordagain = document.getElementById('errorpasswordagain');
        errorpasswordagain.style.display = 'none';
    });
    });

        setTimeout(() => {
            var successrecord = document.getElementById('successrecord');
                successrecord.style.display = 'none';
        }, 3000);

        setTimeout(() => {
            var errornickname2 = document.getElementById('errornickname2');
                errornickname2.style.display = 'none';
        }, 3000);

    </script>
</body>
</html>