@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-content-center h-100">
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-header">Inicio de sesión</div>

                <div class="card-body">
                    <form method="POST" class="row justify-content-center" action="{{ route('login') }}">
                        @csrf
                        <div class="col-12 col-lg-8">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="credential" class=" text-md-end">Correo o Usuario</label>

                                    <input id="credential" type="text"
                                        class="form-control @error('credential') is-invalid @enderror" name="credential"
                                        value="{{ old('credential') }}" required autocomplete="credential" autofocus>

                                    @error('credential')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="password" class="text-md-end">Contraseña</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Recordarme
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Iniciar Sesión
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
