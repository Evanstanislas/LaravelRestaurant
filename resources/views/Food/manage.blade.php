@extends('./components/navbar')

@section('title', 'Manage Food')


@section('Main')
    <div class="WholePage">
        <div class="MainPage">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show alertXDD" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            
            <div class="menu">
                <p class="menutext">管理食物|Manage Food</p>
            </div>

            <div class="searchContainer">
                <form action="{{route('managesearch')}}" method="post">
                    @csrf
                    <div class="searchBar">
                        <input type="search" name="query" placeholder="Enter Food Name" size="70" class="inputForm">
                        <input type="submit" value="Search" class="btn btn-outline-secondary">

                    </div>
                    
                    <div class="filterBar">
                        <span class="filtertext">Filter by category:</span>
                            <input type="checkbox" name="filter[]" id="filter1" value="Main Course">
                            <label for="filter1">Main Course</label>
                            <input type="checkbox" name="filter[]" id="filter2" value="Beverages">
                            <label for="filter2">Beverages</label>
                            <input type="checkbox" name="filter[]" id="filter3" value="Desserts">
                            <label for="filter3">Desserts</label>
                    </div>
                </form>
            </div>

            @if (count($foods)==0)
                    <div class="empty">
                        <p class="emptyText">Sorry, We didn't find the food you want</p>
                    </div>
                @else
                    <div class="manageFood">
                        @foreach ($foods as $food)
                            <div class="foodContent">
                                <div class="foodContainer">
                                    <a href="{{ route('detail',['id' => $food->id]) }}"><img src="{{asset('storage/images/'.$food->picture)}}" alt="image" class="manageFoodImage"></a>
                                    <div class="manageFoodText">
                                        <a href="{{ route('detail',['id' => $food->id]) }}" class="foodName" style="text-align:initial">{{$food->name}}</a>
                                        <p class="manageFoodDesc">Category:</p>
                                        <p class="manageFoodDesc">{{$food->category}}</p>
                                        <p class="manageFoodDesc">Description:</p>
                                        <p class="manageFoodDesc">{{$food->brief}}</p>
                                    </div>
                                </div>
                                <div class="btn-group mb-2">
                                    <a href="{{ route('update',['id' => $food->id]) }}" role="button" class="btn btn-secondary">Update</a>
                                    <form action="{{route('remove', ['id' => $food->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Remove</button>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    </div>
            @endif
        </div>

    </div>
@endsection
