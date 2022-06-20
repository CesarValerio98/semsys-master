@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Servicio') }}</div>

                <div class="card-body">
                        <form action="{{ url('/root/university/services/'.encrypt($info->id).'') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="60" value="{{ $info->name }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipo">Tipo</label>
                                <input type="text" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" id="tipo" name="tipo" maxlength="45" value="{{ $info->type }}" placeholder="Ingrese un tipo" required autofocus>
                                @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" placeholder="Ingrese una descripción del servicio" rows="5" maxlength="255" autofocus required>{{ $info->description }}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="universidad">Universidad</label>
                                <select name="universidad" id="universidad" class="form-control universidad" required autofocus style="width: 100%; height: 40px;">
                                    <option value="{{$info->university_id}}" selected>{{$info->university->name}}</option>
                                    @foreach($all as $info)
                                    <option value="{{$info->id}}">{{ $info->name }}</option>
                                    @endforeach
                                </select>
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
