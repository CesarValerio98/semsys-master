@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">  {{ __('EVALUACIONES') }} - <strong> {{ $all->name }} {{ $all->f_surname }} {{ $all->s_surname }} </strong></div>
                <a href="{{ url('/root/university/studentevaluations/create2/'.encrypt($all->id).'') }}" class="btn btn-success">Añadir</a>
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
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Archivo</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            <!-- {{$i = 1}} -->
                            @foreach($evaluations as $info)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $info->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary show-modal" id="{{$info->file}}">
                                    Ver
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ url('/root/university/studentevaluations/'.encrypt($info->id).'/edit') }}" class="btn btn-warning" role="button">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ url('/root/university/studentevaluations/'.encrypt($info->id)) }}" method="POST">
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

<!-- Modal -->
<div class="modal fade" id="showm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Archivo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12" align="center" id="content_archivo">
    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
    </div>

@endsection

@section('js')
<script>
    $(document).ready(function() {

        $(".show-modal").on('click',function () {
            var ido = $(this).attr('id');
            $("#content_archivo").html('<embed src="/img/'+ido+'") }}" type="application/pdf" width="100%" height="500px" />');
            $('#showm').modal('show');
        });

    });
</script>
@endsection
