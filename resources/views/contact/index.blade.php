@extends('layouts.app')

@section('content')
    <section class="relative pt-10 text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col w-full mb-12 text-center">
                <h1 class="mb-4 text-2xl font-medium text-gray-900 sm:text-3xl title-font">Contact Us</h1>
            </div>
            <form method="POST" action="{{ route('contact.confirm') }}">
                @csrf

                <div class="mx-auto lg:w-1/2 md:w-2/3">
                    <div class="flex flex-wrap -m-2">
                        <div class="w-1/2 p-2">
                            <div class="relative">
                                <label for="name" class="text-sm leading-7 text-gray-600">Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200">
                            </div>
                        </div>
                        <div class="w-1/2 p-2">
                            <div class="relative">
                                <label for="email" class="text-sm leading-7 text-gray-600">Email</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200">
                                @if ($errors->has('email'))
                                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="w-full p-2 border-orange-200 border-solid border-3">
                            <label for="title" class="text-sm leading-7 text-gray-600">タイトル</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="w-full px-3 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200">
                            @if ($errors->has('title'))
                                <p class="mt-1 text-xs text-red-500">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="w-full p-2">
                            <div class="relative">
                                <label for="message" class="text-sm leading-7 text-gray-600">Message</label>
                                <textarea id="message" name="body"
                                    class="w-full px-0 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none resize-none h-96 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200">
                                    {{ old('body') }}
                                </textarea>
                                @if ($errors->has('body'))
                                    <p class="mt-1 text-xs text-red-500">{{ $errors->first('body') }}</p>
                                @endif

                            </div>
                        </div>
                        <div class="w-full p-2">
                            <button type="submit"
                                class="flex px-8 py-2 mx-auto text-lg text-white bg-green-500 border-0 rounded focus:outline-none hover:bg-green-600">入力内容確認</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
