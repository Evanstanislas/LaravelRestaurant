@extends('./components/navbar')

@section('title', 'Add New Food')

@section('Main')
    <div class="WholePage">
        <div class="MainPage">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="alertXDD">{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <div class= "formXDD">
                <p class="menutext">添加新食物|Add New Food</p>
                <form action="{{route('executeadd')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="formContent">
                        <label for="name">Food Name</label>
                        <br>
                        <input type="text" name="name"placeholder="Minimum 5 characters" size="100" class="inputForm">
                    </div>

                    <div class="formContent">
                        <label for="brief">Food Brief Description</label>
                        <br>
                        <input type="text" name="brief"placeholder="Maximum 100 characters" size="100" class="inputForm">
                    </div>

                    <div class="formContent">
                        <label for="detail">Food Full Description</label>
                        <br>
                        <input type="text" name="detail" id="" placeholder="Maximum 255 characters" size="100" class="inputForm">
                    </div>

                    <div class="formContent">
                        <label for="category" class="text">Food Category</label>
                        <br>
                        <select id="category" name="category" class="form-control">
                            <option value="Main Course">Main Course</option>
                            <option value="Beverages">Beverages</option>
                            <option value="Desserts">Desserts</option>
                        </select>
                    </div>

                    <div class="formContent">
                        <label for="price">Food Price</label>
                        <br>
                        <input type="text" name="price" id="" placeholder="Must be more than 0" size="100" class="inputForm">
                    </div>

                    <div class="formContent">
                        <label for="picture">Food Picture</label>
                        <br>
                        <input type="file" name="picture" id="">
                    </div>

                    <div class="mb-3">
                        <div class="btn-group">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-outline-secondary">Place Order</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>
@endsection
