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
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Usuarios</div>
                            @can('users.create')
                                <a href="{{ route('usuarios.create') }}" class="btn btn-primary text-white">
                                    <i class="fas fa-plus-circle"></i> Nuevo
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('usuarios.show', $user) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{ route('usuarios.edit', $user) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-bs-whatever="{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay registros en esta tabla.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('users.delete')
        <x-confirm-delete-modal route="usuarios" message="el usero" />
    @endcan
@endsection
