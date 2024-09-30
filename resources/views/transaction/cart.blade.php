@extends('./components/navbar')

@section('title', 'Cart')


@section('Main')
    <div class="WholePage">
        <div class="BackgroundImage">
        </div>
        <div class="MainPage">
            <div class="menu">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show alertXDD" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                <p class="menutext" style="text-align: center">你的购物车|Your Cart</p>
                @if (count($Cart)===0)
                    <div class="empty">
                        <div class="empty">
                            <p class="emptyText">Looks like it's empty :(</p>
                            <p class="emptyText">Seems that you haven't looked at our delicious food yet. 
                                Buy more foods to add to your cart.</p>
                        </div>
                    </div>
                @else
                    <div class="cartTable">
                        <table>
                            <thead>
                                <tr>
                                    <th>Food</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Cart as $item)
                                    <tr>
                                        <td>{{$item->food}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>
                                            <div class="quantityTable">
                                                <form action="{{route('minusQuantity', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-primary minus-btn">-</button>
                                                </form>
                                                <p class="quantityDisplay">{{$item->quantity}}</p>
                                                <form action="{{route('addQuantity', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-primary plus-btn">+</button>
                                                </form>
                                                
                                            </div>
                                        </td>
                                        <td>{{$item->total}}</td>
                                        <td>
                                            <form action="{{route('removeCart', $item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h2>Total price: ${{$totalPrice}}</h2>
                        <a href="/checkout" role="button" class="btn btn-outline-secondary">Checkout</a>
                        {{-- <form action="{{route('checkout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">Checkout</button>
                        </form> --}}
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
