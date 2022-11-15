@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/trabajador/'.$trabajador->id ) }}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}

@include('trabajador.form',['modo'=>'Editar']);

</form>

</div>
@endsection

