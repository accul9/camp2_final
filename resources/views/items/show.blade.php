@extends('layouts.app')
{{-- ↑テンプレを読み込む --}}

@section('content')
    <div class="flex flex-row w-full p-[80px]">
        {{-- 左半分 --}}
        <div class="flex flex-col w-1/2 mt-30">

            <div class="grid p-10 mx-auto mt-40 rounded-lg shadow-lg justify-items-center bg-gray-50">
                <img class="object-cover w-[480px] h-[360px] rounded-t-lg" src="{{ asset($item->item_image) }}" alt="content">
            </div>
        </div>

        {{-- 右半分 --}}
        <div class="flex flex-col w-1/2 p-20 mx-auto mt-20">

            <h1
                class="mb-10 text-2xl font-bold text-gray-900 underline sm:text-3xl title-font underline-offset-8 decoration-green-500">
                {{ $item->item_name }}
            </h1>
            <div class="text-gray-500">
                {!! $item->item_description !!}
            </div>
            <div class="mt-10">
                <p class="text-xl text-gray-500">商品単位：{{ $item->item_unit }}</p>
                <p class="my-2 text-xl text-gray-500">販売価格：&yen{{ $item->item_price }}</p>

            </div>

            <div class="flex flex-col justify-start">
                {{-- 購入ボタン --}}
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->item_id }}">
                    <p class="my-5 text-xl text-gray-500">数量：
                        <select name="quantity" id="quantity"
                            class="w-[100px] px-2 py-1 mt-2 border border-gray-300 rounded" required>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </p>
                    <div flex flex-row>
                        <button
                            class="flex w-[210px] justify-center mr-10 px-8 py-2 my-10 text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">
                            カートに追加
                        </button>
                        <input type="hidden" name="redirect" value="{{ route('cart.add') }}">
                        {{-- セット一覧に戻るボタン --}}
                        <a href="{{ route('items.index') }}">
                            <x-green-button>商品一覧に戻る</x-green-button>
                        </a>
                    </div>
                </form>


            </div>



        </div>
    </div>
@endsection
