@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-0 shadow-sm">
                <div class="card-header border-0 bg-white">
                    <h5>Crear Producto</h5>
                </div>
                <div class="card-body bg-white">
                    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                                        <label for="name">Nombre del producto</label>
                                    </div>
                                    {{--
                                    <div class="mb-3"><button type="submit" class="btn btn-primary text-center">Guardar</button></div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="brand" name="brand" placeholder="">
                                        <label for="name">Marca</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="category_id" name="category_id">
                                          <option>Selecciona categoría</option>
                                          @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                          @endforeach
                                        </select>
                                        <label for="category_id">Categoría del producto</label>
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="file" id="data_sheet" name="data_sheet">
                                        <label for="name">Ficha técnica</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="file" id="featured" name="featured">
                                        <label for="name">Imagen</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="sku" name="sku" placeholder="">
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
