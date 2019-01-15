@extends('layouts.baseApp')


@section('title')
	403 Acceso No Autorizado
@endsection


@section('head')

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-exclamation-triangle "></i> ERROR 403
	<small>Acceso No Autorizado</small>
</h1>

@endsection

@section('content')


<div class="error-page">
	<h2 class="headline text-red"> 403</h2>

	<div class="error-content">
	  <h3><i class="fa fa-warning text-red"></i> Acceso No Autorizado </h3>

	  <br>
	  <p>
	    Permiso denegado. No tenes permisos para acceder el recurso. Verifica tus permisos o ponete en contacto con un administrador.
	    Volve a INICIO haciendo <a href="{{url('/home')}}">CLICK ACA</a>
	  </p>

	</div>
	<!-- /.error-content -->
</div>
	
@endsection


