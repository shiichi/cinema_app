<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Larael test app</title>
 
    <!-- CSS <link href="/css/app.css" rel="stylesheet">　-->
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/business-casual.css" rel="stylesheet">

</head>
 
<body>
    <div class="brand">Horita IT School</div>
    <div class="address-bar">Technology is best for our future.</div>
    {{-- ナビゲーションバーの Partial を使用 --}}
    @include('navbar')
    <div class="container">
        {{-- フラッシュメッセージの表示 --}}
        @if (Session::has('flash_message'))
            <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
        @endif
        {{-- コンテンツの表示 --}}
        @yield('content')
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; shiichi saito 2015</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>
</html>