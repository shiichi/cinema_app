@extends('layout')
 
@section('content')
<h1>『{{ $searchtext }}』の検索結果</h1>
<ul class="accordion-tabs">
  <li class="tab-header-and-content">
    <a href="javascript:void(0)" class="is-active tab-link">映画</a>
    <div class="tab-content">
        {!! $movies->render() !!}
        @foreach($movies as $movie)
        <div class="item" style="float:left;">
          <h3 class="">{{ $movie['produced'] }}</h3>
          <a href="/cinema/movie/{{ $movie['id'] }}">
            <div class="image" style="">
              <img src="/img/noimg.png" alt="{{ $movie['title'] }}" class="">
            </div>
            <h3>{{ $movie['title'] }}</h3>
          </a>
          <div class="bk_w clearflt clearboth">
            <p class="">観た</p>
            <p class="">観たい</p>
          </div>
        </div>
        @endforeach
    </div>
  </li>
  <li class="tab-header-and-content">
    <a href="javascript:void(0)" class="tab-link">人物</a>
    <div class="tab-content">
      {!! $people->render() !!}
      @foreach($people as $person)
      <div class="item" style="float:left;">
        <a href="/cinema/person/{{ $person['id'] }}">
          <div class="image" style="">
            <img src="/img/noimg.png" alt="{{ $person['title'] }}" class="">
          </div>
          <h3>{{ $person['name'] }}</h3>
        </a>
      </div>
      @endforeach

    </div>
  </li>
  <li class="tab-header-and-content">
    <a href="javascript:void(0)" class="tab-link">ユーザー</a>
    <div class="tab-content">
      {!! $companies->render() !!}
      @foreach($companies as $company)
      <div class="item">
        <a href="/cinema/company/{{ $company['id'] }}">
          <h3>{{ $company['name'] }}</h3>
        </a>
      </div>
      @endforeach
    </div>
  </li>
</ul>
@stop