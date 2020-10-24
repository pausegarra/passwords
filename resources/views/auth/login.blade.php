@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row mt-5">
                <div class="col text-center">
                    <img src="{{ asset('img/LOGO_PASSWORDS_0035AD.svg') }}" width="25%" alt="">
                    <div class="row mt-2">
                        <div class="col-4 mx-auto">
                            <div class="card card-body border-top-tecnol rounded-top">
                                <h1 class="text-center">Entrar</h1>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Correo elctrónico" class="form-control">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Contraseña" class="form-control">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-tecnol btn-block">Entrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection