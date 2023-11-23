@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-0 shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h4 class="fw-bold mt-2">Editar Producto</h4>
                </div>
                <div class="card-body bg-white">
                    <form action="{{route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating @error('name') is-invalid @enderror">
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            placeholder=""
                                            value="{{ old('name', $product->name) }}"
                                        >
                                        <label for="name">Nombre del producto</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('name')
                                            <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating @error('brand') is-invalid @enderror">
                                        <input
                                            type="text"
                                            class="form-control @error('brand') is-invalid @enderror"
                                            id="brand"
                                            name="brand"
                                            placeholder=""
                                            value="{{ old('brand', $product->brand) }}"
                                        >
                                        <label for="brand">Marca</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('brand')
                                            <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating @error('price') is-invalid @enderror">
                                        <input
                                            type="text"
                                            class="form-control @error('price') is-invalid @enderror"
                                            id="price"
                                            name="price"
                                            placeholder=""
                                            value="{{ old('price', $product->price) }}"
                                        >
                                        <label for="price">Precio</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('price')
                                            <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating @error('name') is-invalid @enderror">
                                        <select
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            id="category_id"
                                            name="category_id"
                                        >
                                            <option value="">Selecciona categoría</option>
                                            @foreach ($categories as $category)
                                                <option
                                                    value="{{$category->id}}"
                                                    @selected(old('category_id', $product->category_id) == $category->id)
                                                >
                                                {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="category_id">Categoría del producto</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('category_id')
                                            <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating @error('data_sheet') is-invalid @enderror">
                                        <input
                                            class="form-control @error('data_sheet') is-invalid @enderror"
                                            type="file"
                                            id="data_sheet"
                                            name="data_sheet"
                                        >
                                        <label for="name">Ficha técnica</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('data_sheet')
                                            <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating @error('featured') is-invalid @enderror">
                                        <input
                                            class="form-control @error('featured') is-invalid @enderror"
                                            type="file"
                                            id="featured"
                                            name="featured"
                                        >
                                        <label for="featured">Imagen</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('featured')
                                            <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="sku"
                                            name="sku"
                                            placeholder=""
                                            value="{{ old('sku', $product->sku) }}"
                                        >
                                        <label for="name">SKU</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
