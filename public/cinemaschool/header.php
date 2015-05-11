<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
<title>CinemaSchool</title>
<meta name="keywords" content="SinemaSchool,映画,大学,映画サークル,■,■,■,■,■" /><!--■に検索してほしい関連ワード-->
<meta name="description" content="Cinema Schoolでは、日本の映画サークルが集い、コンテスト形式で映画のレビューを紹介しています。"><!--●にホームページの概要説明文。検索結果の概要文に表示されます-->
<link rel="shortcut icon" href="<?php echo $path; ?>img/favicon.ico">
<link rel="stylesheet" href="<?php echo $path; ?>css/common.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo $path . "css/" . $page . ".css"; ?>" type="text/css" media="screen">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="<?php echo $path; ?>js/script.js"></script>
</head>
<body>

<div id="page-top"><a href="#wrap"><img src="<?php echo $path; ?>img/go_to_top.png" alt="上へスクロール" title="上へスクロール"></a></div>

<div id="header">
    <div id="header_box">
       <div id="logo_title">
              <img src="<?php echo $path; ?>img/logotitle.png" alt="logotitle" title="logotitle">
       </div>
       <div id="sns_button">
       </div>
       <div id="sns_top">
          <ul>
              <li><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook-japan.com%2F&layout=button_count&show_faces=false&width=100&action=like&colorscheme=light&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe>
</li>
              <li><a href="https://twitter.com/share" class="twitter-share-button" data-via="ushiford2">Tweet</a>
              <li><a href="#"><img src="<?php echo $path; ?>img/google.png" alt="google" height="16" width="16">Google+</a></li><br>
           <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</li>
          </ul>
        </div>
    </div>
</div><!--headerend-->

  <div id="menu">
    <ul>
      <li id="menu_top"><a href="<?php echo $path; ?>index.php">トップ</a></li>
      <li id="menu_about"><a href="<?php echo $path; ?>about.php">企画の詳細</a></li>
      <li id="menu_contestlist"><a href="<?php echo $path; ?>contestlist.php">過去のコンテスト</a></li>
      <li id="menu_movielist"><a href="<?php echo $path; ?>movielist.php">映画一覧</a></li>
      <li id="menu_dantai"><a href="<?php echo $path; ?>dantai.php">団体一覧</a></li>
      <li id="menu_contact"><a href="<?php echo $path; ?>contact.php">お問い合わせ</a></li>
    </ul>
  </div>


