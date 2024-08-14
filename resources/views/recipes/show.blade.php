@extends('layouts.app')
{{-- ↑テンプレを読み込む --}}

@section('content')
    <div class="flex flex-row w-full p-[80px]">
        {{-- 左半分 --}}
        <div class="flex flex-col w-1/2 mt-14">


            <div class="grid p-8 mx-auto mt-20 rounded-lg shadow-lg justify-items-center bg-gray-50">
                <img class="object-cover w-[640px] h-[480px] rounded-t-lg" src="{{ asset($recipe->recipe_image) }}"
                    alt="content">
            </div>
        </div>

        {{-- 右半分 --}}
        <div class="flex flex-col w-1/2 p-8 mx-auto mt-10">
            <div class="w-full mt-20">
                <h1
                    class="text-2xl font-bold text-gray-900 underline sm:text-3xl title-font underline-offset-8 decoration-green-500">
                    {{ $recipe->recipe_name }}</h1>
            </div>
            <div>
                <h2 class="mb-5 text-2xl font-semibold mt-14">材料：</h2>
                {!! $recipe->recipe_ingredients !!}
            </div>

            <div class="mt-10">
                <h2 class="mb-5 text-2xl font-semibold">作り方：</h2>
                {!! $recipe->recipe_description !!}
            </div>


            <div class="flex flex-row justify-between w-2/3">
                {{-- 購入ボタン --}}
                <a href="{{ route('recipes.items', ['recipe_id' => $recipe->recipe_id]) }}">
                    <x-green-button>使用食材を見る </x-green-button>
                </a>
                {{-- セット一覧に戻るボタン --}}
                <a href="{{ route('sets.show', ['set' => $set->set_id]) }}">
                    <x-green-button>レシピ一覧に戻る</x-green-button>
                </a>
            </div>
        </div>
    </div>
@endsection
