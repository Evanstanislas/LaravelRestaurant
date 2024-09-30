<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
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

            <h2>Login</h2>
            <form action="{{route('executelogin')}}" method="POST" class="form-group">
                @csrf
                <p class="text">Email Address</p>
                <input type="email" name="email" placeholder="Has to end with @gmail.com" class="box" required>
                <p class="text">Password</p>
                <input type="password" name="password" placeholder="Minimum 5 characters, maximum 255 characters" class="box" required>
                <div class="rememberMe">
                    <label for="remember" class="text">Remember me</label>
                    <input type="checkbox" name="remember" value="1">
                </div>
                <input type="submit" value="Login" class="btn btn-light loginSubmit">
                
            </form>
            <p class="text">Don't have an account? <a href="register" class="linkLogin">Sign up</a></p> <br>

        </div>

    </div>
</body>
</html>
