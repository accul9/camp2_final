@extends('layouts.app')

@section('content')
    <div class="container items-start w-full px-5 py-24 mx-auto mt-5">
        <x-generic-h1>
            プロフィール編集
        </x-generic-h1>
        <form method="POST" action="{{ route('profile.update') }}" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md"
            style="max-width: 500px;">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="last_name">姓<span
                        class="ml-3 text-xs text-red-300">＊必須</span></label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="last_name" value="{{ Auth::user()->last_name }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="first_name">名<span
                        class="ml-3 text-xs text-red-300">＊必須</span></label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="first_name" value="{{ Auth::user()->first_name }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">メール<span
                        class="ml-3 text-xs text-red-300">＊必須</span></label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="email" name="email" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="user_postcode">郵便番号<span
                        class="ml-3 text-xs text-red-300">＊必須</span><span
                        class="ml-3 text-xs text-red-300">ハイフン不要</span></label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="user_postcode" value="{{ Auth::user()->user_postcode }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="user_address">住所<span
                        class="ml-3 text-xs text-red-300">＊必須</span></label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="user_address" value="{{ Auth::user()->user_address }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="user_phone">電話番号<span
                        class="ml-3 text-xs text-red-300">＊必須</span></label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="user_phone" value="{{ Auth::user()->user_phone }}" required>
            </div>

            <button
                class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline"
                type="submit">更新する</button>

        </form>
    </div>
@endsection
