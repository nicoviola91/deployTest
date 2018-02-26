@extends('templates.template')

@section('title','Registro de nuevo usuario')

@section('content')

  {!! Form::open(['route'=> 'users.store', 'method' => 'POST']) !!}

    <div class="form-group">
      {!! Form::label('name','Nombre') !!}
      {!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Ingrese su nombre', 'required']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('email','Correo electrónico') !!}
      {!! Form::email('email',null, ['class' => 'form-control','placeholder' => 'example@gmail.com', 'required']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('password','Contraseña') !!}
      {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Ingrese su contraseña', 'required']) !!}
    </div>

    <div class="form-group">
      {!! Form::submit('Registrar' ,['class'=>'btn btn-primary']) !!}
    </div>

  {!! Form::close() !!}

@endsection
