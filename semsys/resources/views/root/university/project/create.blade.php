@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Crear Proyecto') }}</div>

                <div class="card-body">
                    <form action="{{ url('/root/university/projects') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="60" value="{{ old('nombre') }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="progreso">Progreso</label>
                                <select class="form-control" name="progreso" id="progreso" autofocus required>
                                    <option value="" selected>Elija una opción</option>
                                    <option value="Pendiente">Pendiente</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="palabras_clave">Palabras Clave</label>
                                <input type="text" class="form-control{{ $errors->has('palabras_clave') ? ' is-invalid' : '' }}" id="palabras_clave" name="palabras_clave" maxlength="45" value="{{ old('palabras_clave') }}" placeholder="Ingrese palabras clave" required autofocus>
                                @if ($errors->has('palabras_clave'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('palabras_clave') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" placeholder="Ingrese una descripción" rows="5" maxlength="255" autofocus required>{{ old('descripcion') }}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="universidad">Universidad</label>
                                <select name="universidad" id="universidad" class="form-control universidad" required autofocus style="width: 100%; height: 40px;">
                                    <option></option>
                                    @foreach($all2 as $info)
                                    <option value="{{$info->id}}">{{ $info->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="estudiantes">Estudiantes</label>
                                <select name="estudiantes[]" id="estudiantes" multiple="multiple" class="form-control estudiantes" required autofocus style="width: 100%; height: 40px;">
                                    @foreach($all as $info2)
                                    <option value="{{$info2->id}}">{{ $info2->name }} {{ $info2->f_surname }} {{ $info2->s_surname }}</option>
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
            placeholder: 'Elija una opción'
        }).width("100%");

        $('.estudiantes').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
            placeholder: 'Elija una opción'
        }).width("100%");

    });
</script>
@endsection
