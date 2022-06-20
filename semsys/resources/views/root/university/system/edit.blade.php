@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Sistema') }}</div>

                <div class="card-body">
                        <form action="{{ url('/root/university/systems/'.encrypt($info->id).'') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="45" value="{{ $info->name }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12" align="right">
                                <button class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.universidad').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
        }).width("100%");
    });
</script>
@endsection
