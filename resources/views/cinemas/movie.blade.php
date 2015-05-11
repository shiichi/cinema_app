@extends('layout')
 
@section('content')
<div class="row">
    <div class="box">
    	<div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Company<strong>blog</strong>
            </h2>
            <hr>
        </div>
        @foreach($movies as $movie)
        <div class="col-lg-12 text-center">
            <h2>{{ $movie->title }}<br><small>{{ $movie->yomi }}</small></h2>
        </div>
        @endforeach
    </div>
</div>
@stop