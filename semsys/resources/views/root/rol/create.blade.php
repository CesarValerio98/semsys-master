@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Crear Rol') }}</div>

                <div class="card-body">
                    <form action="{{ url('/root/rol/all') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="45" value="{{ old('nombre') }}" placeholder="Ingrese un nombre" required autofocus>
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
$( document ).ready(function() {
    $("#telefono").inputmask({"mask": "(+52) 999-999-99-99"});
});
</script>

@endsection
