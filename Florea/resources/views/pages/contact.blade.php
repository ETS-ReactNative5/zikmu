@extends('layout.app')

@section('title')
    Contact
@endsection

@section('content')
    @if ($errors->all())
        <div class="container">
            <div class="alert alert-danger">Il y a des erreurs dans le formulaire</div>
        </div>
    @endif
    @if(session()->get('success'))
        <div class="container">
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        </div>
    @endif
    <div class="container">
        <h2 class="text-center">Contactez nous</h2>
        <form action="{{route('contact.post')}}" method="POST" id="contact">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" name="email" id="email" placeholder="Votre adresse email" value="{{old('email') ?? ''}}" >
                <div class="invalid-feedback">
                    {{$errors->first('email') ?? ''}}
                </div>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control {{$errors->first('subject') ? 'is-invalid' : ''}}" name="subject" id="email" placeholder="Le sujet de votre message" value="{{old('subject') ?? ''}}">
                <div class="invalid-feedback">
                    {{$errors->first('subject') ?? ''}}
                </div>
            </div>
            <div class="mb-3">
                <textarea name="message" id="" cols="30" rows="10" placeholder="Votre message" class="form-control {{$errors->first('message') ? 'is-invalid' : ''}}" >{{old('message') ?? ''}}</textarea>
                <div class="invalid-feedback">
                    {{$errors->first('message') ?? ''}}
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Envoyer">
            </div>
        </form>
    </div>
@endsection