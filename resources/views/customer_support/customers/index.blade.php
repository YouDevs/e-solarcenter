@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-0 shadow-sm">
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                <th scope="col">Empresa</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{$customer->company_name}}</th>
                                    <td>{{$customer->user->name}}</td>
                                    <td>{{$customer->rfc}}</td>
                                    <td>
                                        <span class="badge rounded-pill {{ $customer->status == 'pending' ? 'text-bg-warning' :
                                                           ($customer->status == 'active' ? 'text-bg-success' :
                                                           'text-bg-danger')}}"
                                        >
                                            {{ ucfirst($customer->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning me-2">Actualizar</a>
                                            <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline ml-2">
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
