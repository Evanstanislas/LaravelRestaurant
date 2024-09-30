@extends('./components/navbar')

@section('title', 'Transaction History')


@section('Main')
    <div class="WholePage">
        <div class="BackgroundImage">
        </div>
        <div class="MainPage">
            <div class="menu">
                <p class="menutext" style="text-align: center">交易记录|Transaction History</p>
            </div>
            @if (count($Transaction)===0)
                    <div class="empty">
                        <div class="empty">
                            <p class="emptyText">There hasn't been any transactions. Yet.</p>
                            <p class="emptyText">Seems that the checks haven't checked, and tummies haven't been filled.</p>
                        </div>
                    </div>
                @else
                <div class="transactionTable">
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Purchase Date</th>
                                <th>Food Name</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Transaction as $item)
                                <td>{{$item->transactions_id}}</td>
                                <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                                <td>{{$item->receipt}}</td>
                                <td>{{$item->total}}</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
        </div>

    </div>
@endsection
