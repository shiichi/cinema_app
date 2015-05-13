<!DOCTYPE html>
<html　lang="ja">
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="/bourbon/css/style.css">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="/bourbon/js/search_movie.js" type="text/javascript" ></script>
</head>
<body>
<div id="wrapper" style="width:90%; margin:auto;">
  <!--　ヘッダー　-->
  <header class="header" role="contentinfo">
    <div class="header-logo">
      <img src="/img/logotitle.png" alt="Logo image">
    </div>
      <ul>
        <li><a href="">About</a></li>
        <li><a href="">Contact</a></li>
        <li><a href="">Products</a></li>
      </ul>

      <div class="header-secondary-links">
        <ul class="">
          @if (Auth::guest())
          {{-- ログインしていない時 --}}
          <li><a href="/auth/login">Login</a></li>
          <li><a href="/auth/register">Register</a></li>
          @else
          {{-- ログインしている時 --}}
          <li class="dropdown">
              <a href="#" class="" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }}
              <span class="caret"></span>
              </a>
              <ul class="" role="menu">
                  <li><a href="/auth/logout">Logout</a></li>
              </ul>
          </li>
        @endif
        </ul>
      </div>
  </header>

{{-- フラッシュメッセージの表示 --}}
@if(Session::has('message'))
    <div class="container">
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    </div>
@endif

  <!--　検索フォーム　-->
  <form class="search-bar" role="search" method="GET" action="/cinema/search_movie">
    <input type="search" name="searchtext"　placeholder="映画・人物を検索" />
    <button type="submit">
      <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
    </button>
  </form>
  <div>
    @yield('content')
  </div>
</div><!-- / .wrapper -->
</body>
</html>