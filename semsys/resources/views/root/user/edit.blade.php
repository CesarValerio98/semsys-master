@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Editar Usuario') }}</div>

                <div class="card-body">
                    <form action="{{ url('/root/user/all/'.encrypt($all->id).'') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="60" value="{{ $all->name }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellido_paterno">Apellido Paterno</label>
                                <input type="text" class="form-control{{ $errors->has('apellido_paterno') ? ' is-invalid' : '' }}" id="apellido_paterno" name="apellido_paterno" maxlength="45" value="{{ $all->f_surname }}" placeholder="Ingrese un apellido paterno" required autofocus>
                                @if ($errors->has('apellido_paterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellido_materno">Apellido Materno</label>
                                <input type="text" class="form-control{{ $errors->has('apellido_materno') ? ' is-invalid' : '' }}" id="apellido_materno" name="apellido_materno" maxlength="45" value="{{ $all->s_surname }}" placeholder="Ingrese un apellido materno" required autofocus>
                                @if ($errors->has('apellido_materno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido_materno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" id="telefono" name="telefono" maxlength="20" value="{{ $all->phone }}" placeholder="Ingrese un teléfono" required autofocus>
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" maxlength="100" value="{{ $all->email }}" placeholder="Ingrese un email" required autofocus autocomplete="email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="rol">Rol</label>
                                <select name="rol" id="rol" class="form-control" required autofocus>
                                    <option value="{{ $all->role->id }}" selected>{{ $all->role->name }}</option>
                                    @foreach($all2 as $info)
                                    <option value="{{$info->id}}">{{$info->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            @if (empty($all->image))
                            
                            @else
                            <div class="form-group col-md-6" align="center">
                                <img src="{{ asset('img/'.$all->image.'') }}" class="img-fluid" height="150" width="150" alt="user_image">
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
$( document ).ready(function() {
    $("#telefono").inputmask({"mask": "(+52) 999-999-99-99"});
});
</script>

@endsection
