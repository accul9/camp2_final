@extends('layouts.app')

@section('content')
    <div class="flex flex-row w-full px-6 pt-[80px]">

        <div class="flex flex-row flex-wrap w-1/2 mt-2">
            @foreach ($recipes as $recipe)
                <div class="p-4 xl:w-1/2 md:w-1/3">
                    <div class="p-8 rounded-lg shadow-lg bg-gray-50">
                        <img class="object-cover object-center w-[320px] h-[200px] mb-6 rounded-t-lg"
                            src="{{ asset($recipe->recipe_image) }}" alt="content">
                        <div class="pt-2 pb-2 rounded-b-lg bg-grey-50">
                            <h2 class="mb-4 text-lg font-medium text-gray-900 title-font">{{ $recipe->recipe_name }}
                            </h2>
                            <a href="{{ route('recipes.show', $recipe->recipe_id) }}">
                                <h3 class="text-xs font-medium tracking-widest text-green-500 title-font">レシピを読む</h3>
                            </a>
                            {{-- <p class="text-base leading-relaxed">{{ $set->set_name }}</p> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col w-1/2 mx-auto p-[100px]">
            <h1
                class="mb-2 text-2xl font-bold text-gray-900 underline sm:text-3xl title-font underline-offset-8 decoration-green-500">
                {{ $set->set_name }}</h1>
            <p class="w-full mt-20 mb-20 leading-relaxed text-gray-500">
                {{ $set->set_description }}
            </p>
            <p class="text-xl text-gray-500">販売価格：&yen{{ $set->set_price }}</p>
            {{-- <p class="my-5 text-xl text-gray-500">数量：
                <select name="quantity" id="quantity" class="w-[100px] px-2 py-1 mt-2 border border-gray-300 rounded">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </p> --}}


            <div class="flex flex-col justify-start">
                {{-- 購入ボタン --}}
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="set_id" value="{{ $set->set_id }}">
                    <p class="my-5 text-xl text-gray-500">数量：
                        <select name="quantity" id="quantity" class="w-[100px] px-2 py-1 mt-2 border border-gray-300 rounded">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </p>
                    <!-- Assuming $set is your set model -->
                    <button type="submit" class="flex w-[210px] justify-center mr-10 mt-10 px-8 py-2 text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">カートに追加</button>
                    <input type="hidden" name="redirect" value="{{ route('cart.add') }}">
                </form>

                <div>
                    {{-- セット一覧に戻るボタン --}}
                    <a href="{{ route('sets.index') }}">
                        <x-green-button class="flex w-[210px] justify-center px-8 py-2  text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">セット一覧に戻る</x-green-button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
