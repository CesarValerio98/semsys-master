@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('PROGRAMAS DE LAS UNIVERSIDADES') }}</div>
                <a href="{{ url('/root/university/programs/create') }}" class="btn btn-success">Añadir</a>
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
                                <th scope="col">Área</th>
                                <th scope="col">Enfoque</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Grado</th>
                                <th scope="col">Universidad</th>
                                <th scope="col">Sistema</th>
                                <th scope="col">Modelo</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- {{$i = 1}} -->
                            @foreach($all as $info)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $info->name }}</td>
                                <td>{{ $info->area }}</td>
                                <td>{{ $info->approach }}</td>
                                <td>{{ $info->type }}</td>
                                <td>{{ $info->grade }}</td>
                                <td>{{ $info->university->name }}</td>
                                <td>{{ $info->system->name }}</td>
                                <td>{{ $info->modality->name }}</td>
                                <td>
                                    <a href="{{ url('/root/university/programs/'.encrypt($info->id).'/edit') }}" class="btn btn-warning" role="button">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ url('/root/university/programs/'.encrypt($info->id)) }}" method="POST">
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
