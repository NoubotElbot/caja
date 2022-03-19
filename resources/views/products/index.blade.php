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
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Productos</div>
                            @can('products.create')
                                <a href="{{ route('productos.create') }}" class="btn btn-primary text-white">
                                    <i class="fas fa-plus-circle"></i> Nuevo
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td @class(['text-danger' => $product->stock < 10])>{{ $product->stock }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('productos.show', $product) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{ route('productos.edit', $product) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-bs-whatever="{{ $product->id }}">
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
    @can('products.delete')
        <x-confirm-delete-modal route="productos" message="el producto" />
    @endcan
@endsection
