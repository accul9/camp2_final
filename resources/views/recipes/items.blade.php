@extends('layouts.app')

@section('content')
    <div class="container w-full py-24 mx-auto mt-5">
        {{-- 上半部分 --}}
        <div class="flex flex-wrap w-full pl-4 mb-10">
            <div class="flex flex-row w-full mb-6 lg:w-1/2 lg:mb-0">
                <x-generic-h1><a
                        href="{{ route('recipes.show', $recipe->recipe_id) }}">{{ $recipe->recipe_name }}</a></x-generic-h1>
                <h2 class="m-5 text-3xl font-medium text-gray-900"> &gt;&nbsp;使用食材一覧</h2>
            </div>
        </div>
        {{-- 下半部分 --}}

        <div class="flex flex-row flex-wrap w-full p-4">
            @foreach ($recipe->items as $item)
                <div class="p-4 xl:w-1/1 md:w-1/4">
                    <div class="p-8 rounded-lg shadow-lg bg-gray-50">
                        <img class="object-cover object-center w-[300px] h-[300px] rounded-t-lg"
                            src="{{ asset($item->item_image) }}" alt="content">
                        <div class="pt-4 pb-4 rounded-b-lg bg-grey-50">
                            <h2 class="mb-4 text-lg font-medium text-gray-900 title-font">{{ $item->item_name }}</h2>
                            <h3 class="text-base font-medium tracking-widest text-green-500 title-font">
                                {{ $item->pivot->used_quantity }}{{ $item->pivot->used_unit !== '-' ? $item->pivot->used_unit : '' }}
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="grid w-full place-items-center">
                <a href="{{ route('recipes.show', $recipe->recipe_id) }}"><x-green-button>レシピに戻る</x-green-button></a>
            </div>


        </div>
    </div>
@endsection
