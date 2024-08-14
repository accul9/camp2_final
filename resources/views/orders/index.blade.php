@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Purchase History</h2>

        {{-- <table class="table">
            <thead>
                <tr>
                    <th>購入項目</th>
                    <th>日付</th>
                    <th>値段</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                        <td>{{ $purchase->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

        @foreach (json_decode($order->item_ids) as $itemId)
            {{-- Fetch and display the item details --}}
        @endforeach

        @foreach (json_decode($order->set_ids) as $setId)
            {{-- Fetch and display the set details --}}
        @endforeach

    </div>
@endsection
