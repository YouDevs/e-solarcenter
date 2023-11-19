@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <a href="{{route('admin.products.create')}}" class="btn btn-primary">Crear</a>
                    <a href="{{route('admin.products.create')}}" class="btn btn-primary">Importar</a>
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($product->featured) }}" alt="Imagen Destacada" width="100">
                                    </td>
                                    <th scope="row">{{$product->name}}</th>
                                    <td>
                                        {{$product->category->name}}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning me-2">Actualizar</a>
                                            <form
                                                action="{{ route('admin.products.destroy', $product) }}"
                                                method="POST"
                                                class="inline ml-2"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
