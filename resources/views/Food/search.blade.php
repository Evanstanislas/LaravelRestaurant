@extends('./components/navbar')

@section('title', 'Search')

@section('Main')
    <div class="WholePage">
        <div class="MainPage">
            <p class="menutext">搜索食物| Search Foods</p>
            <div class="searchContainer">
                <form action="{{route('search')}}" method="post">
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
            @if (count($result)==0)
                <div class="empty">
                    <p class="emptyText">Sorry, We didn't find the food you want</p>
                </div>
            @else
                <div class="manageFood">
                    @foreach ($result as $food)
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
                    @endforeach
                </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $result->links() }}
            </div>
        </div>
    </div>

@endsection
