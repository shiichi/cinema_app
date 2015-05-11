@extends('layout')
 
@section('content')
<div class="row">
    <div class="box">
    @if (Auth::check())
        {!! link_to('articles/create', 'Create Article', ['class' => 'btn btn-primary']) !!}
    @endif
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Company<strong>blog</strong>
            </h2>
            <hr>
        </div>
        @foreach($articles as $article)
        <div class="col-lg-12 text-center">
            <h2>{{ $article->title }}<br><small>{{ $article->published_at }}</small></h2>
            <p>{{ $article->body }}</p>
            <a href="{{ url('articles', $article->id) }}" class="btn btn-default btn-lg">Read More</a>
            <hr>
        </div>
        @endforeach

    </div>
</div>



@stop