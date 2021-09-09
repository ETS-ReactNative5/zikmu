@extends('layout.app')

@section('title')
    Confirmation de commande
@endsection

@section('content')
    <div class="container">
        @if(session()->get('success'))
            <div class="container">
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            </div>
        @endif
    </div>
@endsection