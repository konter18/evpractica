@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/trabajador') }}" method="post" enctype="multipart/form-data">
@csrf
@include('trabajador.form',['modo'=>'Crear']);

</form>
</div>
@endsection