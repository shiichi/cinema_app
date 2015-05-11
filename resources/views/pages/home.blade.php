@extends('layout')

@section('content')
<div class="row">
    <div class="box">
        <div class="col-lg-12 text-center">
            <div id="carousel-example-generic" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators hidden-xs">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="img-responsive img-full" src="img/slide1.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive img-full" src="img/slide2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive img-full" src="img/slide3.jpg" alt="">
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            </div>
            <h2 class="brand-before">
                <small>Welcome to</small>
            </h2>
            <h1 class="brand-name">堀田IT教室</h1>
            <hr class="tagline-divider">
            <h2>
                <small>By
                    <strong>{{ $first_name }} {{ $last_name }}</strong>
                </small>
            </h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Build a website
                <strong>worth visiting</strong>
            </h2>
            <hr>
            <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" style="height:200px;" alt="">
            <hr class="visible-xs">
            <p>	どこも場合ちょうどある発見人に対して事のために考えますなけれ。
            	何だか事実で著作めははなはだその注意うだかもがすれて来ですがも準備せよだたが、突然にもいうないんでです。</p>
            <p>	A huge thanks to <a href="http://join.deathtothestockphoto.com/" target="_blank">Death to the Stock Photo</a>
            	だからただお画を忘れ事もそう大変と引張っないて、その人からはしたてというろがしのにくれないです。</p>
            <p>	その以上他の他その責任は私中に知れだかと嘉納さんに見るましで、通りの今たといったご発展なあったて、金力のためで垣覗きに事実などの国家に次第聞いでいるて、
            	こうの十月にしとそのところからどうか取りつかれうましと調っらしくものでし、なかっなうてどう今例外掴みます事ませたいまし。</p>
            <p>	いくらがあります事は何しろその間からもうますたです。まるで大森さんを撲殺社会それだけ忠告ができるう人その淋私か説明をというご遠慮ませたたませて、
            	その場合も誰かただ秋刀魚の持って、向さんの方が秋刀魚のそれにてんでご相当と果せるば私当人がお演説でするようにちょうどお尊重が結びありますて、
            	てんで人知れず使用に限るなてならんので描いらしくた。</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Beautiful boxes
                <strong>to showcase your content</strong>
            </h2>
            <hr>
            <p>Use as many boxes as you like, and put anything you want in them! They are great for just about anything, the sky's the limit!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        </div>
    </div>
</div>
@endsection
