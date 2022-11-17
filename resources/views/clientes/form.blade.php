<h1>{{ $modo }} Clientes</h1>

@if (count($errors) > 0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>


@endif
<div class="form-group">
    <label for="nombre"> Nombre</label>
    <input type="text" class="form-control" name="nombre"
        value="{{ isset($cliente->persona->nombre) ? $cliente->persona->nombre : old('nombre') }}" id="nombre">
</div>

<div class="form-group">
    <label for="apellidos"> Apellidos</label>
    <input type="text" class="form-control" name="apellidos"
        value="{{ isset($cliente->persona->apellidos) ? $cliente->persona->apellidos : old('apellidos') }}" id="apellidos">

</div>

<div class="form-group">
    <label for="telefono"> Telefono</label>
    <input type="text" class="form-control" name="telefono"
        value="{{ isset($cliente->persona->telefono) ? $cliente->persona->telefono : old('telefono') }}" id="telefono">

</div>

<div class="form-group">
    <label for="correo"> Correo</label>
    <input type="text" class="form-control" name="correo"
        value="{{ isset($cliente->persona->correo) ? $cliente->persona->correo : old('correo') }}" id="correo">

</div>


<div class="form-group">
    <label for="rut"> Rut</label>
    <input type="text" class="form-control" name="rut"
        value="{{ isset($cliente->rut) ? $cliente->rut : old('rut') }}" id="rut">

</div>

<div class="form-group">
    <label for="direccion">Direccion</label>
    <input type="text" class="form-control" name="direccion"
        value="{{ isset($cliente->direccion) ? $cliente->direccion : old('direccion') }}" id="direccion">

</div>

<div class="form-group">
    <label for="foto"></label>
    @if (isset($cliente->persona->foto))
        <img class="img-thumbnail img-fluid" style="height:250px;width:300px" src="{{ asset('storage') . '/' . $cliente->persona->foto }}" alt="">
    @endif
    <input type="file" class="form-control" name="foto" value="" id="foto">
    <br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} Datos">

<a class="btn btn-primary" href="{{ url('clientes') }}">Regresar</a>
