@extends('layout')
 
@section('content')
<div class="row">
    <div class="box">
    <h1>Write a New Article</h1>
 
    <hr/>

    @include('errors.form_errors')

    {{-- フォーム --}}
    {!! Form::open(['route' => 'articles.store']) !!}
        @include('articles.form', ['published_at' => date('Y-m-d'), 'submitButton' => 'Edit Article'])
    {!! Form::close() !!}
    </div>
</div>
@stop