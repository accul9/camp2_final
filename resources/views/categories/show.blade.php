@extends('layouts.app')

@section('content')
    <div class="container w-full px-5 py-24 mx-auto mt-5">
        {{-- 上半部分 --}}
        <div class="flex flex-wrap w-full pl-4 mb-10">
            <div class="flex flex-row w-full mb-6 lg:w-1/2 lg:mb-0">
                <x-generic-h1><a href="{{ route('items.index') }}">商品一覧</a></x-generic-h1>
                <h2 class="m-5 text-3xl font-medium text-gray-900"> &gt;&nbsp;{{ $category->name }}</h2>
            </div>
        </div>
        {{-- 下半部分 --}}
        <div class="flex flex-row w-full">
            {{-- サイドバー --}}
            <div class="flex flex-col w-1/4 p-8 m-4 rounded-xl bg-gray-50">
                <ul>
                    @foreach ($categories as $category)
                        <li class="p-2 mb-4 text-gray-900 hover:bg-[#eff5d7] hover:text-xl rounded-lg">
                            <a href="{{ route('categories.show', $category->category_id) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex flex-wrap w-3/4 p-4 -m-4">
                @foreach ($items as $item)
                    <div class="p-4 xl:w-1/1 md:w-1/3">
                        <div class="p-8 rounded-lg shadow-lg bg-gray-50">
                            <img class="object-cover object-center w-[270px] h-[270px] rounded-t-lg"
                                src="{{ asset($item->item_image) }}" alt="content">
                            <div class="pt-4 pb-4 rounded-b-lg bg-grey-50">
                                <h2 class="mb-4 text-lg font-medium text-gray-900 title-font">{{ $item->item_name }}</h2>
                                <a href="{{ route('items.show', $item) }}">
                                    <h3 class="text-xs font-medium tracking-widest text-green-500 title-font">詳細を見る</h3>
                                </a>
                                {{-- <p class="text-base leading-relaxed">{{ $set->set_name }}</p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-3">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
