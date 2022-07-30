@extends('layouts.auth')
@section('content')
<div class="card-body">
    <form method="POST" action="{{route('password.email')}}">
        @csrf
        <div class="h5 modal-title text-center">
            <h4 class="mt-2">

                <div class="d-flex justify-content-center">
                    <!-- <img src="{{url('images/logo.png?20220531')}}" width="120px" class="img-fluid" alt=""> -->
                </div>
                <x-shared.auth-title title="¿Olvidaste tu contraseña?" subtitle="Completa el siguiente formulario para recuperarla">
                    </x-shared>
                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif
            </h4>
        </div>
        <div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group">
                        <label for="exampleEmail" class="text-uppercase text-muted">Correo</label>
                        <input name="email" id="exampleEmail" type="email" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <h6 class="mb-0">
            <a href="{{route('login')}}" class="auth-form-link">
                Iniciar sesión con una cuenta existente
            </a>
        </h6>
        <div class="modal-footer clearfix">
            <div class="float-right">
                <button class="btn btn-primary btn-lg">Recuperar contraseña</button>
            </div>
        </div>
    </form>
</div>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection