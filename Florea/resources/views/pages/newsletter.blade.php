@extends('layout.app')

@section('title')
    Désinscription
@endsection

@section('content')
    @if(session()->get('success'))
        <div class="container">
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        </div>
    @endif
    @if(session()->get('warning'))
        <div class="container">
            <div class="alert alert-warning">
                {{session()->get('warning')}}
            </div>
        </div>
    @endif
    <div class="container">
        <form action="{{route('newsletter.unsub.post')}}" method="POST" id="newsletter">
            @csrf
            <div class="mb-3">
                <input name="newsletter_email" type="email" value="{{old('newsletter_email')}}" placeholder="Email" class="form-control @error('newsletter_email', 'newsletter_unsub') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('newsletter_email', 'newsletter_unsub')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="se désinscrire">
            </div>
        </form>
    </div>
@endsection