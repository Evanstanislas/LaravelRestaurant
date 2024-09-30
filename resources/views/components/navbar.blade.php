<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('./image/XDDLogo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/Home.css')}}">

</head>
<body>
    <nav class="navbar navbar-nav">
        <div class="navigation-bar">
            <div class="navigation-text">
                <div class="navLeft">
                    <img src="{{asset('/image/XDDLogo.png')}}" alt="Logo">
                    <a href="/" class="XDD" ><b>XiAO DiNG DoNG</b></a>
                    <a href="/" class="HOME">Home</a>
                    @auth
                        @if(auth()->user()->role=="User")
                        <a href="/search" class="HOME">Search Food</a>
                        <a href="/cart" class="HOME">Cart</a>
                        @else
                        <a href="/addnewfood" class="HOME">Add New Food</a>
                        <a href="/managefood" class="HOME">Manage Food</a>
                        @endif
                    @endauth
                </div>
                @auth
                    <div class="logText">
                        <a class="dropdown" href="#" role="button" data-bs-toggle="dropdown">
                            <p class="dropdown-item-text">Welcome, {{Auth::user()->username}}!</p>
                            <div class="navLog">
                                @if (!Auth::user()->picture)
                                    <img src="{{asset('image/NoPP.png')}}" alt="empty" class="profilePicture">
                                @else
                                    <img src="{{asset('storage/images/'.Auth::user()->picture)}}" alt="thereis" class="profilePicture">
                                @endif
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/editprofile">Profile</a></li>
                            @if(auth()->user()->role=="User")
                                <li><a class="dropdown-item" href="/history">Transaction History</a></li>
                            @endif
                            <form action="/logout" method="post" class="dropdown-item">
                                @csrf
                                <input type="submit" value="Logout" class="logoutButton">
                            </form>
                        </ul>
                    </div>
                @endauth
                @guest
                    <div class="navGuest">
                        <a href="login" class="Header">Login</a>
                        <a href="register" class="Header">Register</a>
                    </div>
                @endguest
            </div>

        </div>
    </nav>

    @yield('Main')

    <div class="footer">
        <div class="footerContent">
            <div class="social">
                <img class="footerPicture" src="{{asset('image/FB.svg')}}" alt="">
                <img class="footerPicture" src="{{asset('image/X.svg')}}" alt="">
                <img class="footerPicture" src="{{asset('image/IG.svg')}}" alt="">
            </div>
            <hr>
            <p class="footerText">2023 XiAo DiNG DoNG. All rights reserved.</p>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>

</body>
</html>
