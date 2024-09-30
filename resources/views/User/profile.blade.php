@extends('./components/navbar')

@section('title', 'Edit Profile')


@section('Main')
    <div class="WholePage">
        <div class="BackgroundImage">
        </div>
        <div class="MainPage">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show alertXDD" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show alertXDD" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="formXDD">
                <p class="menutext" style="text-align: center">编辑个人资料|Edit Profile</p>
                <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="formContent">
                        <label for="username">Username</label>
                        <br>
                        <input type="text" name="username" placeholder="Minimum 5 characters" size="100" required class="inputForm">
                    </div>
                    <div class="formContent">
                        <label for="email">Email</label>
                        <br>
                        <input type="email" name="email" placeholder="Must end with @gmail.com" size="100" class="inputForm">
                    </div>
                    <div class="formContent">
                        <label for="phonenumber">Phone Number</label>
                        <br>
                        <input type="text" name="phonenumber" placeholder="Must contain 12 numbers" size="100" class="inputForm">
                    </div>
                    <div class="formContent">
                        <label for="address">Address</label>
                        <br>
                        <input type="text" name="address" placeholder="Don't have to be filled, minimum 5 characters" size="100" class="inputForm">
                    </div>
                    <div class="formContent">
                        <label for="profile">New Profile Picture</label>
                        <br>
                        <input type="file" name="profile">
                    </div>
                    <div class="formContent">
                        <label for="password">Password</label>
                        <br>
                        <input type="password" name="password" placeholder="Must be the same as your password" size="100" class="inputForm">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-secondary">Update Profile</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
