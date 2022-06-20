@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('CREAR EVALUACIÓN') }} - <strong> {{ $all->name }} {{ $all->f_surname }} {{ $all->s_surname }}</strong></div>
                    <div class="float-right">
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/root/university/studentevaluations') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="student" class="form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" value="{{encrypt($all->id)}}">
                    @if ($errors->has('student'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('student') }}</strong>
                        </span>
                    @endif
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="evaluacion">Nombre de la evaluación</label>
                                <input type="text" name="evaluacion" class="form-control{{ $errors->has('evaluacion') ? ' is-invalid' : '' }}" id="evaluacion" maxlength="100" placeholder="Ingrese un nombre" value="{{ old('evaluacion') }}" required autofocus>
                                @if ($errors->has('evaluacion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('evaluacion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="archivo_evaluacion">Archivo de Evaluación</label>
                                <input type="file" class="form-control{{ $errors->has('archivo_evaluacion') ? ' is-invalid' : '' }}" id="archivo_evaluacion" name="archivo_evaluacion" accept="application/pdf" value="{{ old('archivo_evaluacion') }}" required autofocus>
                                @if ($errors->has('archivo_evaluacion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('archivo_evaluacion') }}</strong>
                                    </span>
                                @endif
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