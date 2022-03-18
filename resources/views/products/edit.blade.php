@extends('layouts.app')

@section('content')
    <div class="container py-5">
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
                        <form action="{{ route('productos.update', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="Ingrese nombre del producto..."
                                        value="{{ old('name', $product->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="price">Precio</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Ingrese precio.." min="1" step="1"
                                        value="{{ old('price', $product->price) }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" placeholder="Ingrese Stock actual del producto..." min="0"
                                        step="1" value="{{ old('stock', $product->stock) }}">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="image">Imagen</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                        name="image">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/no-image.png') }}"
                                        width="120" height="120" id="preview" style="object-fit: cover">
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
@section('scripts')
    <script type="text/javascript">
        const input = document.querySelector('#image');
        input.addEventListener('change', function() {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#preview').setAttribute('src', e.target
                        .result); // Renderizamos la imagen
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
