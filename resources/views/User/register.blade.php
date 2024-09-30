<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/LogReg.css')}}">
</head>
<body>
    <div class="MainLogin">
        <div class="LoginImage">
        </div>
        <div class="LoginForm">
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <h2>Register</h2>
            <form action="{{route('executeregister')}}" method="POST" class="form-group">
                @csrf
                <p class="text">Email Address</p>
                <input type= "text" id= "email" name="email" placeholder="Has to end with @gmail.com"
                class="box" required> <br>
                <p class="text">Username</p>
                <input type= "text" name="username" placeholder=
                "Minimum 5 characters, maximum 50 characters" class="box" required> <br>
                <p class="text">Password</p>
                <input type= "password" name="password" placeholder=
                "Minimum 5 characters, maximum 255 characters" class="box" required> <br>
                <p class="text">Confirm Password</p>
                <input type= "password" name="confirm" placeholder=
                "Has to be the same with Password field"  class="box" required> <br>
                <input type="submit" value="Register" class="btn btn-light loginSubmit">
            </form>
            <p class="text">Already have an account? <a href="login" class="linkLogin">Log in</a></p>
        </div>
    </div>
</body>
</html>
