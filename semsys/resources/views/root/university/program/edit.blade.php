@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Editar Programa') }}</div>

                <div class="card-body">
                    <form action="{{ url('/root/university/programs/'.encrypt($info->id).'') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="60" value="{{ $info->name }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="area">Área</label>
                                <input type="text" class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" id="area" name="area" maxlength="45" value="{{ $info->area }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enfoque">Enfoque</label>
                                <input type="text" class="form-control{{ $errors->has('enfoque') ? ' is-invalid' : '' }}" id="enfoque" name="enfoque" maxlength="45" value="{{ $info->approach }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('enfoque'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('enfoque') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipo">Tipo</label>
                                <input type="text" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" id="tipo" name="tipo" maxlength="45" value="{{ $info->type }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="grado">Grado</label>
                                <input type="text" class="form-control{{ $errors->has('grado') ? ' is-invalid' : '' }}" id="grado" name="grado" maxlength="45" value="{{ $info->grade }}" placeholder="Ingrese el grado" required autofocus>
                                @if ($errors->has('grado'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grado') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if (empty($info->image))
                            
                            @else
                            <div class="form-group col-md-6" align="center">
                                <img src="{{ asset('img/'.$info->image.'') }}" class="img-fluid" height="150" width="150" alt="user_image">
                            </div>  
                            @endif
                            <div class="form-group col-md-6">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" id="imagen" name="imagen" accept="image/*" value="{{ old('imagen') }}" autofocus>
                                @if ($errors->has('imagen'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('imagen') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="universidad">Universidad</label>
                                <select name="universidad" id="universidad" class="form-control universidad" required autofocus style="width: 100%; height: 40px;">
                                    <option value="{{ $info->university_id }}" selected>{{ $info->university->name }}</option>
                                    @foreach($all as $info2)
                                    <option value="{{$info2->id}}">{{ $info2->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12" align="center">
                                @if ($errors->any())
                                    @if ($errors->first('sistema'))
                                    <li class="alert alert-danger">{{ $errors->first('sistema') }}</li>
                                    @elseif($errors->first('modalidad'))
                                    <li class="alert alert-danger">{{ $errors->first('modalidad') }}</li>
                                    @endif
                                @endif
                            </div>

                            <div class="col-md-6" align="center">
                                <label for="sistemas">Sistema</label>

                                <div id="dynamic_field">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <select name="sistema" id="sistema" class="form-control" required style="width: 100%; height: 40px;" autofocus>
                                                <option value="{{ $info->system->id }}">{{ $info->system->name }}</option>
                                            @foreach ($all2 as $item2)
                                                <option value="{{$item2->id}}">{{$item2->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" align="center">
                                <label for="modalidad">Modalidad</label>
                                <div id="dynamic_field2">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <select name="modalidad" id="modalidad" class="form-control" required style="width: 100%; height: 40px;" autofocus>
                                                <option value="{{ $info->modality->id }}">{{ $info->modality->name }}</option>
                                                @foreach ($all3 as $item3)
                                                    <option value="{{$item3->id}}">{{$item3->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
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

        $('#sistema').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
        }).width("100%");

        $('#modalidad').select2({
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
