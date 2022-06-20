@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('DIRECCIÓN') }} - <strong> {{ $all->name }} </strong></div>
                    <div class="float-right">
                        <form action=" {{ url('/root/addressuni/all/'.encrypt($all->id).'')}}" method="GET">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Atras</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/root/addressuni/all/') }}">
                    @csrf
                    <input type="hidden" name="university" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" value="{{encrypt($all->id)}}">
                    @if ($errors->has('university'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('university') }}</strong>
                        </span>
                    @endif
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="calle">Nombre de la calle</label>
                                <input type="text" name="calle" class="form-control{{ $errors->has('calle') ? ' is-invalid' : '' }}" id="calle" maxlength="100" placeholder="Ingrese un nombre" value="{{ old('calle') }}" required autofocus>
                                @if ($errors->has('calle'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('calle') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="numero">Número</label>
                                <input type="number" name="numero" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" id="numero" placeholder="Ingrese un Número" value="{{ old('numero') }}" min="0" max="9999999" required autofocus>
                                @if ($errors->has('numero'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="referencia">Referencia del domicilio</label>
                                <textarea name="referencia" class="form-control{{ $errors->has('referencia') ? ' is-invalid' : '' }}" id="referencia" placeholder="Ingrese un descripción del lugar donde vive" rows="5" maxlength="255" autofocus required>{{ old('referencia') }}</textarea>
                                @if ($errors->has('referencia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('referencia') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="codigo_postal">Código Postal</label>
                                <input type="text" name="codigo_postal" class="form-control{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }}" id="codigo_postal" placeholder="Ingrese un Número" value="{{ old('codigo_postal') }}" maxlength="20" autofocus>
                                @if ($errors->has('codigo_postal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codigo_postal') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="campus">Campus</label>
                                <input type="text" name="campus" class="form-control{{ $errors->has('campus') ? ' is-invalid' : '' }}" id="campus" placeholder="Ingrese un nombre" value="{{ old('campus') }}" maxlength="50" autofocus>
                                @if ($errors->has('campus'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('campus') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control state" id="estado" required autofocus style="width:100%; height: 38px;">
                                    <option value="">Elija una opción</option>
                                    @foreach ($state as $item1)
                                    <option value="{{ $item1->id }}">{{ $item1->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="municipio">Municipio</label>
                                <select name="municipio" class="form-control municipality" id="municipio" required autofocus style="width:100%; height: 38px;">
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="localidad">Localidad</label>
                                <select name="localidad" class="form-control location" id="localidad" required autofocus style="width:100%; height: 38px;">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-sm-12" align="right">
                                <button type="submit"  class="btn btn-success">Guardar</button>
                            </div>
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
        $('.state').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
        }).width("100%");

        $('.municipality').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
        }).width("100%");

        $('.location').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
        }).width("100%");

        $('#estado').on('change', function() {
        $('#localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
			$("#estado option:selected").each(function () {
			state = $(this).val();
            $.ajax({
      				url: "/root/addressuni/viewmunicipalities",
      				method: "GET",
      				data: {'state':state},
                    success:function(data){
                        $("#municipio").html(data);
                    }
                });
            });
        });

        $("#municipio").change(function () {
            $("#municipio option:selected").each(function () {
                municipio = $(this).val();
                $.ajax({
      				url: "/root/addressuni/viewlocations",
      				method: "GET",
      				data: {'municipio':municipio},
                    success:function(data){
                        $("#localidad").html(data);
                    }
                });       
            });
        });
    });
</script>
@endsection