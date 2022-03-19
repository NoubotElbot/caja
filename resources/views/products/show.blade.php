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
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Producto #{{ $product->id }}</div>
                            @can('products.create')
                                <a href="{{ route('productos.index') }}" class="btn btn-secondary">
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
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio:</th>
                                        <td>{{ $product->price }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock:</th>
                                        <td @class(['text-danger' => $product->stock < 10])>{{ $product->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ultima modificación:</th>
                                        <td>{{ \Carbon\Carbon::parse($product->updated_at)->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-6 text-end">
                                <a href="{{ route('productos.edit', $product) }}" class="btn btn-sm btn-secondary">
                                    Editar <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-bs-whatever="{{ $product->id }}">
                                    Eliminar <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('products.delete')
        <x-confirm-delete-modal route="productos" message="el producto" />
    @endcan
@endsection
