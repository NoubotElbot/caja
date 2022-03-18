@extends('layouts.app')

@section('content')
    <div class="container py-5 px-0">
        <div class="row justify-content-center">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ps-2 py-2">
                            <div class="h4 titulo fw-bold col-12 col-md-6 ">Registrar Venta</div>
                            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-angle-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <h1 id="total">Total: $0</h2>
                            </div>
                            @forelse ($products as $product)
                                <div class="col-4 col-lg-3 p-0 p-lg-2 mb-2">
                                    <div class="card h-100" style="min-height: 14rem">
                                        <div class="h-50">
                                            <a class="add-product-btn" product="{{ $product->id }}">
                                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/no-image.png') }}"
                                                    class="card-img-top w-100 h-100 @if (!$product->image) d-none @endif d-md-block"
                                                    alt="{{ $product->name }}" style="object-fit: cover;">
                                                @if (!$product->image)
                                                    <h5 class="text-center pt-2 d-md-none">
                                                        {{ $product->name }}
                                                    </h5>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="card-body text-center px-0 pb-0">
                                            <h5 class="card-title">
                                                <p class="d-none d-md-block">{{ $product->name }}</p>
                                                <p>
                                                    ${{ $product->price }}
                                                    <span class="badge rounded-pill bg-primary"
                                                        id="{{ $product->id . '-count' }}">
                                                        x0
                                                    </span>
                                                </p>

                                            </h5>
                                            <button id="{{ $product->id . '-sub' }}"
                                                class="btn p-0 text-danger d-none sub-product-btn" type="button"
                                                product="{{ $product->id }}">
                                                <i class="fas fa-minus-circle fa-2x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No hay productos.</p>
                                <a href="{{ route('productos.create') }}" class="btn btn-primary">Agregar</a>
                            @endforelse
                        </div>
                        <div class="text-start mt-2">
                            <button type="button" class="btn btn-primary" disabled id="save-btn">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/ventas/vender.js') }}"></script>
@endsection
