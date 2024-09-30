@extends('./components/navbar')

@section('title', 'Food Detail')

@section('Main')
    <div class="WholePage">
        <div class="MainPage">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif
            <p class="menutext" style="text-align: center">食物细节|Food Detail</p>
                <div class="detailbox">
                    <div class="detailcontainer">
                        <img class="detailimage" src="{{asset('storage/images/'.$food->picture)}}" alt="Image">
                        <div class="detailtext">
                            <p>{{$food->name}}</p>
                            <p>Food Type:</p>
                            <p class="foodDesc">{{$food->category}}</p>
                            <p>Food Price:</p>
                            <p class="foodDesc">${{$food->price}}</p>
                            <p>Brief Description:</p>
                            <p class="foodDesc">{{$food->brief}}</p>
                            <p>About this food</p>
                            <p class="foodDesc">{{$food->detail}}</p>

                            @auth
                                @if (auth()->user()->role=="User")
                                    <form action="{{ route('addcart',['id' => $food->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary">Add to Cart</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
