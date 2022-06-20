@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('ROLES') }}</div>
                <a href="{{ url('/root/rol/all/create') }}" class="btn btn-success">Añadir</a>
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- {{$i = 1}} -->
                            @foreach($all as $rol)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $rol->name }}</td>
                                <td>
                                    <a href="{{ url('/root/rol/all/'.encrypt($rol->id).'/edit') }}" class="btn btn-warning" role="button">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ url('/root/rol/all/'.encrypt($rol->id)) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
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
@endsection
