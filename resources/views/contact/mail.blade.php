@extends('layouts.app')

@section('content')
    <section class="relative pt-10 text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="mx-auto lg:w-1/2 md:w-2/3">
                <h2>お問い合わせ内容を受け付けました。</h2>
                <h3>お名前</h3>
                <p>{!! $name !!}</p>
                <h3>Mail</h3>
                <p>{!! $email !!} </p>
                <h3>タイトル</h3>
                <p>{!! $title !!}</p>
                <h3>お問い合わせ内容</h3>
                <p>{!! nl2br($body) !!}</p>
            </div>
        </div>
    </section>
@endsection
