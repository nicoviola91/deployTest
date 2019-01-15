@extends('layouts.baseApp')


@section('title')
	500 Error
@endsection


@section('head')

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-exclamation-triangle "></i> ERROR 500
	<small>Error</small>
</h1>

@endsection

@section('content')


<div class="error-page">
	<h2 class="headline text-red"> 500</h2>

	<div class="error-content">
	  <h3><i class="fa fa-warning text-red"></i> Ups! Algo salio mal </h3>

	  <br>
	  <p>
	    Ocurrio un error al procesar tu solicitud. Volve a intentarlo o ponete en contacto con un administrador
	    Volve a INICIO haciendo <a href="{{url('/home')}}">CLICK ACA</a>
	  </p>

	</div>
	<!-- /.error-content -->
</div>
	
@endsection


