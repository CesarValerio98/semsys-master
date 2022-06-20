@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('UNIVERSIDADES') }}</div>
                <a href="{{ url('/root/university/all/create') }}" class="btn btn-success">Añadir</a>
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
                                <th scope="col">Teléfono</th>
                                <th scope="col">Email</th>
                                <th scope="col">A cargo</th>
                                <th scope="col">Direcciones</th>
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
                                <td>{{ $info->phone }}</td>
                                <td>{{ $info->email }}</td>
                                <td>{{ $info->user->name }} {{ $info->user->f_surname }} {{ $info->user->s_surname }}</td>
                                <td>
                                    <form action=" {{ url('/root/addressuni/all/'.encrypt($info->id).'')}}" method="GET">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary">Direcciones</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ url('/root/university/all/'.encrypt($info->id).'/edit') }}" class="btn btn-warning" role="button">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ url('/root/university/all/'.encrypt($info->id)) }}" method="POST">
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
