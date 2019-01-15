@extends('layouts.baseApp')


@section('title')
	404 Pagina No Encontrada
@endsection


@section('head')

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-exclamation-triangle "></i> ERROR 404
	<small>Pagina no encontrada</small>
</h1>

@endsection

@section('content')


<div class="error-page">
	<h2 class="headline text-yellow"> 404</h2>

	<div class="error-content">
	  <h3><i class="fa fa-warning text-yellow"></i> Pagina no encontrada </h3>

	  <br>
	  <p>
	    No encontramos la pagina que estas buscando o no existe.
	    Volve a INICIO haciendo <a href="{{url('/home')}}">CLICK ACA</a>
	  </p>

	</div>
	<!-- /.error-content -->
</div>
	
@endsection


