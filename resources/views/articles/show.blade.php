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
        @unless ($article->tags->isEmpty())
        <div>
	        <h5>Tags:</h5>
	        <ul>
	            @foreach($article->tags as $tag)
	                <li>{{ $tag->name }}</li>
	            @endforeach
	        </ul>
        </div>
    	@endunless
        <div class="col-lg-12 text-center">
            <h2>{{ $article->title }}<br><small>{{ $article->published_at }}</small></h2>
            <p>{{ $article->body }}</p>
            <a href="{{ url('articles', $article->id) }}">Read More</a>
            <hr>
        </div>

        {!! link_to(action('ArticlesController@edit', [$article->id]), '編集', ['class' => 'btn btn-primary col-lg-4']) !!}
        {!! delete_form(['articles', $article->id]) !!}

    </div>
</div> 
@stop