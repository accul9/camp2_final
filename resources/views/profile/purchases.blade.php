@extends('layouts.app')

@section('content')
    <h1>Purchase History</h1>
    <ul>
        @foreach ($purchases as $purchase)
            <li>
                Purchase ID: {{ $purchase->id }} -
                Purchased On: {{ $purchase->created_at->toFormattedDateString() }} -
                Total: ${{ $purchase->total }}
                <!-- Add more details as needed -->
            </li>
        @endforeach
    </ul>
@endsection
