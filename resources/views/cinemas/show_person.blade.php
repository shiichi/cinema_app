@extends('layout')
 
@section('content')
<div class="col-lg-12 text-center">
    <h2><span>{{ $person->name }}</span><small>{{ $person->sub_name }}</small></h2>
    <h3>{{ $person->sub_name }}</h3>
    <p class="">出身：{{ $person->born }}</p>
    <p class="">生年月日：{{ $person->birth }}／{{ $person->deth }}</p>

	<div class="line">
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
</div>
@stop