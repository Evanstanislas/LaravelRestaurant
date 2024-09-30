@extends('./components/navbar')

@section('title', 'XiAO DiNG DoNG')

@section('Main')
    <div class="WholePage">
        <div class="MainPage">
            <div class="Menu">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show alertXDD" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                <p class="menutext">菜单| Menu</p>
                <br>

                <div class="menubutton">
                    <form action="{{route('filtercategory')}}" method="POST">
                        @csrf
                        <button class="btn btn-outline-secondary" type="submit" name="category" value="maincourse">主菜| Main Course</button>
                        <button class="btn btn-outline-secondary" type="submit" name="category" value="beverages">饮料| Beverages</button>
                        <button class="btn btn-outline-secondary" type="submit" name="category" value="desserts">甜点| Desserts</button>
                    </form>
                </div>
                <br>

                <div class="menubanner">
                    @if ($category==="maincourse")
                        <p class="menuheader">主菜| Main Course</p>
                    @elseif ($category==="beverages")
                    <p class="menuheader">饮料| Beverages</p>
                    @elseif ($category==="desserts")
                    <p class="menuheader">甜点| Desserts</p>
                    @else
                    <p class="menuheader">All Items</p>
                    @endif
                </div>

                <div class="displayfood">
                    @foreach ($foods as $food)
                        <div>
                            <a href="{{ route('detail',['id' => $food->id]) }}"><img src="{{asset('storage/images/' . $food->picture) }}" class="foodImage" alt="image"></a>
                            <br>
                            <a href="{{ route('detail',['id' => $food->id]) }}" class="foodName">{{$food->name}}</a>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $foods->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection


