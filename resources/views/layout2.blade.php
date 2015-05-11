<!DOCTYPE html>
<html>
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
        <ul>
          <li><a href="">Terms and Conditions</a></li>
          <li><a href="">Privacy Policy</a></li>
        </ul>
      </div>
  </header>
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