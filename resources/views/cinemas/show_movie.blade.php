@extends('layout2')
 
@section('content')
<div class="col-lg-12 text-center">
    <h2><span>{{ $movie->title }}</span><small>{{ $movie->produced }}</small></h2>
    <h3>{{ $movie->ori_title }}</h3>
    <p class="">{{ $movie->released }}</p>
    <p class="">製作国：{{ $movie->country->name }}／{{ $movie->runtime }}分</p>
    <dl class="">
      <dt>監督</dt>
      <dd class="">
          <ul class="">
              @foreach($directores as $director)
              <li><a href="/cinema/person/{{ $director['id'] }}" style=""><span>{{ $director['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>脚本</dt>
      <dd class="">
          <ul class="">
              @foreach($screenplaies as $screenplay)
              <li><a href="/cinema/person/{{ $screenplay['id'] }}" style=""><span>{{ $screenplay['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>原作</dt>
      <dd class="">
          <ul class="">
              @foreach($baseds as $based)
              <li><a href="/cinema/person/{{ $based['id'] }}" style=""><span>{{ $based['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>製作総指揮</dt>
      <dd class="">
          <ul class="">
              @foreach($e_produceres as $e_producer)
              <li><a href="/cinema/person/{{ $e_producer['id'] }}" style=""><span>{{ $e_producer['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>製作</dt>
      <dd class="">
          <ul class="">
              @foreach($produceres as $producer)
              <li><a href="/cinema/person/{{ $producer['id'] }}" style=""><span>{{ $producer['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>撮影</dt>
      <dd class="">
          <ul class="">
              @foreach($cameras as $camera)
              <li><a href="/cinema/person/{{ $camera['id'] }}" style=""><span>{{ $camera['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>美術</dt>
      <dd class="">
          <ul class="">
              @foreach($p_designeres as $p_designer)
              <li><a href="/cinema/person/{{ $p_designer['id'] }}" style=""><span>{{ $p_designer['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>音楽・音響</dt>
      <dd class="">
          <ul class="">
              @foreach($musics as $music)
              <li><a href="/cinema/person/{{ $music['id'] }}" style=""><span>{{ $music['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>編集</dt>
      <dd class="">
          <ul class="">
              @foreach($film_editores as $film_editor)
              <li><a href="/cinema/person/{{ $film_editor['id'] }}" style=""><span>{{ $film_editor['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>作画</dt>
      <dd class="">
          <ul class="">
              @foreach($animations as $animation)
              <li><a href="/cinema/person/{{ $animation['id'] }}" style=""><span>{{ $animation['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>字幕・吹替</dt>
      <dd class="">
          <ul class="">
              @foreach($localizations as $localization)
              <li><a href="/cinema/person/{{ $localization['id'] }}" style=""><span>{{ $localization['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>出演</dt>
      <dd class="">
          <ul class="">
              @foreach($casts as $cast)
              <li><a href="/cinema/person/{{ $cast['id'] }}" style=""><span>{{ $cast['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>配給会社</dt>
      <dd class="">
          <ul class="">
              @foreach($distributed_companies as $distributed_company)
              <li><a href="/cinema/company/{{ $distributed_company['id'] }}" style=""><span>{{ $distributed_company['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
      <dt>製作会社</dt>
      <dd class="">
          <ul class="">
              @foreach($produced_companies as $produced_company)
              <li><a href="/cinema/company/{{ $produced_company['id'] }}" style=""><span>{{ $produced_company['name'] }}</span></a></li>
              @endforeach
          </ul>
      </dd>
    </dl>
</div>
@stop