<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta charset="UTF-8">
    <title>メインページ</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css.map') }}">
    <link rel="stylesheet" href="{{ asset('css/styleS.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.scss') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


</head>

<body class="antialiased">

    <header>
        <nav>
            <a class="header-logo-link" href="#">
                <img class="header-logo-img" src="{{ asset('storage/logo.png') }}" alt="A descriptive alternative text"
                    title="Additional information about the image">
            </a>
            <ul class="mainnav">
                <li><a href="{{ route('sets.index') }}">
                        <p class="nava">Sets</p>
                    </a></li>
                <li><a href="{{ route('items.index') }}">
                        <p class="nava">Items</p>
                    </a></li>
                <li><a href="">
                        <p class="nava">Shop</p>
                    </a></li>
            </ul>

            {{-- <ul class="mainnav mainnav1">
                <li><a href="{{ route('login') }}">
                        <p class="nava">Login</p>
                    </a></li>
                <li><a href="{{ route('register') }}">
                        <p class="nava">Sign-up</p>
                    </a></li>
            </ul> --}}
        </nav>
    </header>

    {{-- < class="container"> --}}
    <section class="snap-section">
        <div class="slideshow">
            <div class="slideshow-image" style="background-image: url('{{ asset('images/camp-2650359_1920.jpg') }}')">
            </div>
            <div class="slideshow-image"
                style="background-image: url('{{ asset('images/abstract-1868624_1920.jpg') }}')">
            </div>
            <div class="slideshow-image"
                style="background-image: url('{{ asset('images/fireplace-1598243_1920.jpg') }}')">
            </div>
            <div class="slideshow-image"
                style="background-image: url('{{ asset('images/oil-lamp-6771785_1920.jpg') }}')">
            </div>
        </div>



        <p class="cap"> HEW-GROUP-4</p>


        <nav class="screen">
            <div class="double-line">
                <ul class="screen_menu">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('items.index') }}">Items</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </nav>



        <!--　 -->
        <div class="empty_1">
            <!-- メニューをposionで固定するための空の要素 -->
            <div class="openbtn"><span></span><span></span><span></span></div>
        </div>

        <div class="empty_2">
            <!-- メイン画像をposionで固定づるための空の要素 -->
        </div>
    </section>




    <section id="intro" class="snap-section">

        <p class="p0"> A New Experience </p>
        <p class="p1">キャンプを、もっとおいしく。</p>
        <p class="p2">キャンプ場での食事がもっと美味しくなるレシピが満載</p>
        <p class="p4">自然の中で味わう新たな食の冒険がここから始まる。</p>


        <div class="p3">
            <a href="{{ route('sets.index') }}">
                <p>一覧はこちらから</p>
            </a>
        </div>

        <img class="img1 slideshow-img" src="{{ asset('images/image1.jpg') }}" alt="">
        <img class="img2 slideshow-img" src="{{ asset('images/image4.jpg') }}" alt="">
    </section>



    {{-- <div class="empty_3">

    </div> --}}
    <section class="snap-section">
        <div class="parallax_box">
            {{-- <div class="front_content"></div> --}}
            <div class="parallax_content img_bg_02">
                {{-- <div class="front_content"></div> --}}
                <p class="paratitle">About Us</p>
                <p class="parap1">当サイトでは、キャンプ場での１つの楽しみである「食」、</p>
                <p class="parap2">いわゆるキャンプ飯をより一層素敵なものするためのサービスを提供しています。</p>
                <p class="parap3">レシピの紹介、食材の単品販売、食材のセット販売などを提供しています。</p>
                <p class="parap4">あなたに、おいしいひと時を。</p>
                <p class="parap5">Backend: Yoshikatsu Takahada, Aichi Chen, Ryo Yamauchi</p>
                <p class="parap6">Frontend: Souichiro Uchima, Hayato Asagawa, Yuuto Hayagawa, Seito Ka</p>
            </div>
        </div>

        <footer class="footer">
            <ul class="md-flex">
                <li><a href="#">About</a></li>
                <li><a href="#">サイトマップ</a></li>
                <li><a href="#">プライバシーポリシー</a></li>
            </ul>
            <p class="copyright">© HAL EVENT WEEK</p>
        </footer>
    </section>




    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>



</body>

</html>
