@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @if (session('alert'))
            <x-alert :type="session('alert.type')" :message="session('alert.message')" :icon="session('alert.icon')" />
        @endif
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ps-2 py-2">
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Usuario #{{ $user->id }}</div>
                            @can('users.create')
                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-angle-left"></i> Volver
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12 col-lg-8">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Nombre:</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username:</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username:</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Correo:</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ultima modificación:</th>
                                        <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-6 text-end">
                                <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-sm btn-secondary">
                                    Editar <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-bs-whatever="{{ $user->id }}">
                                    Eliminar <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('users.delete')
        <x-confirm-delete-modal route="usuarios" message="el usuario" />
    @endcan
@endsection
