@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ps-2 py-2">
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Editar Usuario #{{ $user->id }}</div>
                            @can('products.create')
                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-angle-left"></i> Volver
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('usuarios.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="Ingrese nombre del producto..."
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="username">Nombre de Usuario</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="name" name="username" placeholder="Ingrese nombre del producto..."
                                        value="{{ old('username', $user->username) }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="'Super Admin'">Correo</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="'Super Admin'" name="email" placeholder="Ingrese correo.."
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="role">Rol</label>
                                    <select class="form-control" name="role" id="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $role->id === $user->roles()->first()->id ? 'selected' : '' }}>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Ingrese contraseña.."
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="password_confirmation ">Confirmar Contraseña</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation ') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Ingrese correo..">
                                    @error('password_confirmation ')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-start mt-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
