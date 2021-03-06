@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Crear Estudiante') }}</div>

                <div class="card-body">
                    <form action="{{ url('/root/university/students') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre" maxlength="60" value="{{ old('nombre') }}" placeholder="Ingrese un nombre" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellido_paterno">Apellido Paterno</label>
                                <input type="text" class="form-control{{ $errors->has('apellido_paterno') ? ' is-invalid' : '' }}" id="apellido_paterno" name="apellido_paterno" maxlength="45" value="{{ old('apellido_paterno') }}" placeholder="Ingrese un apellido paterno" required autofocus>
                                @if ($errors->has('apellido_paterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellido_materno">Apellido Materno</label>
                                <input type="text" class="form-control{{ $errors->has('apellido_materno') ? ' is-invalid' : '' }}" id="apellido_materno" name="apellido_materno" maxlength="45" value="{{ old('apellido_materno') }}" placeholder="Ingrese un apellido materno" required autofocus>
                                @if ($errors->has('apellido_materno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido_materno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telefono">Tel??fono</label>
                                <input type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" id="telefono" name="telefono" maxlength="20" value="{{ old('telefono') }}" placeholder="Ingrese un tel??fono" required autofocus>
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email_escolar">Email Escolar</label>
                                <input type="text" class="form-control{{ $errors->has('email_escolar') ? ' is-invalid' : '' }}" id="email_escolar" name="email_escolar" maxlength="100" value="{{ old('email_escolar') }}" placeholder="Ingrese un email" required autofocus autocomplete="email">
                                @if ($errors->has('email_escolar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_escolar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email_personal">Email Personal</label>
                                <input type="text" class="form-control{{ $errors->has('email_personal') ? ' is-invalid' : '' }}" id="email_personal" name="email_personal" maxlength="100" value="{{ old('email_personal') }}" placeholder="Ingrese un email" required autofocus autocomplete="email">
                                @if ($errors->has('email_personal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_personal') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="estatus">Estatus</label>
                                <select name="estatus" id="estatus" class="form-control" required autofocus>
                                <option value="" selected>Elija una opci??n</option>
                                <option value="Estudiante">Estudiante</option>
                                <option value="Egresado">Egresado</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" id="imagen" name="imagen" accept="image/*" value="{{ old('imagen') }}" required autofocus>
                                @if ($errors->has('imagen'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('imagen') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cv">Curriculum Vitae</label>
                                <input type="file" class="form-control{{ $errors->has('cv') ? ' is-invalid' : '' }}" id="cv" name="cv" accept="application/pdf" value="{{ old('cv') }}" required autofocus>
                                @if ($errors->has('cv'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cv') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12" align="center">
                                @if ($errors->any())
                                    @if ($errors->first('programa'))
                                    <li class="alert alert-danger">{{ $errors->first('programa') }}</li>
                                    @endif
                                @endif
                            </div>
                    
                            <div class="col-md-12" align="center">
                                <label for="programa">Programa</label>
                                <div id="dynamic_field">
                                    <div class="row">
                                        <div class="form-group col-md-10">
                                            <select name="programa[]" id="programa" class="form-control" onchange="Unique(this,'+i+');" style="width: 100%; height: 40px;" required autofocus>
                                            <option></option>
                                            @foreach ($all as $item)
                                            <option value="{{$item->id}}">{{$item->university->name}} - {{$item->name}} - {{$item->system->name}} - {{$item->modality->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2"><button type="button" name="add" id="add" class="btn btn-primary">A??adir</button></div>
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
        $("#telefono").inputmask({"mask": "(+52) 999-999-99-99"});
        
        $("#email_personal").inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
            cardinality: 1,
            casing: "lower"
            }
        }});

        $("#email_escolar").inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
            cardinality: 1,
            casing: "lower"
            }
        }});

        $('#programa').select2({
            language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando..";
            }
            },
            placeholder: "Elija una opci??n",
        }).width("100%");

        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<div class="row" id="row'+i+'">' +
                                        '<div class="form-group col-md-10"> <select name="programa[]" onchange="Unique(this,'+i+');" class="form-control programa'+i+'" required autofocus style="width: 100%; height: 40px;"><option></option>@foreach ($all as $item)<option value="{{$item->id}}">{{$item->university->name}} - {{$item->name}}</option>@endforeach</select><small class="duplicate" id="duplicate'+i+'" style="color:red;" hidden>Intento duplicar un programa.</small></div><div class="form-group col-md-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');
            $('.programa'+ i).select2({
            language: {
                    noResults: function() {
                        return "No hay resultado";
                    },
                    searching: function() {
                        return "Buscando..";
                    }
                },
                placeholder: "Elija una opci??n",
            }).width("100%");         
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
           $('#row'+ id).remove();
        });
});


function Unique(ele,i) {
    var values = $("select[name='programa[]']")
        .map(function(){return $(this).val();}).get();
    
    function check(repet) {
        return repet == ele.value;
    }
    var unique = values.filter(check);
    if(unique.length >= 2){
        $('.programa'+i).val(null).trigger('change');
        $("#duplicate"+i).attr("hidden",false);
    }else{
        $(".duplicate").attr("hidden",true);
    }
}

</script>
@endsection
