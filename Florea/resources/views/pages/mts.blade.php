@extends('layout.app')

@section('title')
    {{$page['title']}}
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">{{$page['title']}}</h2>
        {!!$page['contenuDePage']!!}
    </div>
@endsection