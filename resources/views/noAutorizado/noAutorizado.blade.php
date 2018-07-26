@extends('layouts.welcomeApp')


@section('title')
	Sin Autorización
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1 align="center">
	<i class="icon fa fa-exclamation-triangle "></i>
	<small></small>
</h1>

@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body" align="center">
			<p>Usted no está autorizado a visualizar la información a la que desea acceder.</p>
		</div>

	</div>
</div>
</div>
	
@endsection


