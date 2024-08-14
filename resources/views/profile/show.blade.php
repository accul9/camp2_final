@extends('layouts.app')

@section('content')
    <div class="container items-center w-full px-5 py-24 mx-auto mt-5">
        <x-generic-h1>
            おかえり、 {{ Auth::user()->name }}さん
        </x-generic-h1>
        <x-generic-h2>
            登録情報
        </x-generic-h2>
        <div class="flex flex-col p-8 bg-gray-100 rounded-lg">
            <p class="m-4 text-lg">お名前：{{ Auth::user()->last_name }}&emsp;{{ Auth::user()->first_name }}</p>
            <p class="m-4 text-lg">メール：{{ Auth::user()->email }}</p>
            <p class="m-4 text-lg">郵便番号：{{ substr_replace(Auth::user()->user_postcode, '-', 3, 0) }}</p>
            <p class="m-4 text-lg">住所：{{ Auth::user()->user_address }}</p>
            <p class="m-4 text-lg">電話番号：{{ Auth::user()->user_phone }}</p>
        </div>

        <x-green-button>
            <a href="{{ route('profile.edit') }}">編集する</a>
        </x-green-button>
    </div>
@endsection
