@extends('layouts.app')

@section('content')
    <section class="relative pt-10 text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col w-full mb-12 text-center">
                <h1 class="mb-4 text-2xl font-medium text-gray-900 sm:text-3xl title-font">Contact Us</h1>
            </div>

            <form method="POST" action = "{{ route('contact.send') }}">
                @csrf
                <div class="mx-auto lg:w-1/2 md:w-2/3">
                    <div class="flex flex-wrap -m-2">
                        <div class="w-1/2 p-2">
                            <div class="relative">
                                <label for="name" class="text-sm leading-7 text-gray-600">Name：</label>
                                <p class="p-2 rounded bg-slate-200">{{ $inputs['name'] }}</p>

                                <input type="hidden" id="name" name="name" value="{{ $inputs['name'] }}">
                            </div>
                        </div>
                        <div class="w-1/2 p-2">
                            <div class="relative">
                                <label for="email" class="text-sm leading-7 text-gray-600">Email：</label>
                                <p class="p-2 rounded bg-slate-200">{{ $inputs['email'] }}</p>
                                <input type="hidden" id="email" name="email" value="{{ $inputs['email'] }}">
                            </div>
                        </div>
                        <div class="w-full p-2 border-orange-200 border-solid border-3">
                            <label for="title" class="text-sm leading-7 text-gray-600">タイトル：</label>
                            <p class="p-2 rounded bg-slate-200">{{ $inputs['title'] }}</p>
                            <input type="hidden" name="title" value="{{ $inputs['title'] }}">
                        </div>
                        <div class="w-full p-2">
                            <div class="relative">
                                <label for="body" class="text-sm leading-7 text-gray-600">Message：</label>
                                <p class="p-2 rounded bg-slate-200">{!! nl2br(e($inputs['body'])) !!}</p>
                                <input id="body" name="body" value="{{ $inputs['body'] }}" type="hidden">
                            </div>
                        </div>
                        <div class="flex flex-row justify-center w-full p-2 m-5 ">
                            <button type="submit" name="action" value="back"
                                class="flex px-8 py-2 mx-2 text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">入力内容修正
                            </button>
                            <button type="submit" name="action" value="submit"
                                class="flex px-8 py-2 mx-2 text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">送信</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
