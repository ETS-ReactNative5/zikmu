@extends('layout.app')

@section('title')
    Confirmation de commande
@endsection

@section('content')
    <div class="container">
        @if(session()->get('error'))
            <div class="container">
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
            </div>
        @endif
    </div>
@endsection