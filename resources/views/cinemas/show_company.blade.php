@extends('layout')
 
@section('content')
<div class="col-lg-12 text-center">
	<div>
	    <h2>{{ $company->name }}</h2>
	</div>
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