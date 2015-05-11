@extends('layout')
 
@section('content')
<div class="row">
    <div class="box">
    	<div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">person<strong>list</strong>
            </h2>
            <hr>
        </div>
        @foreach($people as $person)
        <div class="col-lg-12 text-center">
            <h2>{{ $person->name }}<br><small>{{ $person->sub_name }}</small></h2>
        </div>
        @endforeach
    </div>
</div>
@stop