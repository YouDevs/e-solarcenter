@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <!-- Contenedor Flex -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <!-- Texto a la izquierda -->
                        <h4 class="fw-bold mt-2">Listado de productos</h4>
                        <!-- Botones a la derecha -->
                        <div>
                            <a href="{{route('admin.products.create')}}" class="btn btn-outline-accent me-2">Crear</a>
                            <a href="{{route('admin.products.create')}}" class="btn btn-outline-accent">Importar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="text-center">
                                    <td>
                                        <img src="{{ Storage::url($product->featured) }}" alt="Imagen Destacada" width="100">
                                    </td>
                                    <th scope="row" class="fw-bold">{{$product->name}}</th>
                                    <th scope="row">{{$product->brand}}</th>
                                    <th scope="row" class="text-accent">${{number_format($product->price, 2, '.', ',')}}</th>
                                    <td>
                                        {{$product->category? $product->category->name: ''}}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning me-2">Actualizar</a>
                                            <form
                                                action="{{ route('admin.products.destroy', $product) }}"
                                                method="POST"
                                                class="inline ml-2"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(this)" class="btn btn-danger">
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

@section('scripts')
<script>
function confirmDelete(button) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, envía el formulario
            button.closest('form').submit();
        }
    });
}
</script>
@endsection
