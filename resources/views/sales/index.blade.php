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
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Ventas</div>
                            @can('sales.create')
                                <a href="{{ route('ventas.create') }}" class="btn btn-primary text-white">
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
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Total</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($sale->created_at)) }}</td>
                                        <td>{{ $sale->user->name }}</td>
                                        <td>${{ $sale->total }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('ventas.show', $sale) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{ route('ventas.edit', $sale) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-bs-whatever="{{ $sale->id }}">
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
                        <div class="d-flex justify-content-center">
                            {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('sales.delete')
        <x-confirm-delete-modal route="ventas" message="la venta" />
    @endcan
@endsection
