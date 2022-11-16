<h1>{{ $modo }} Trabajador</h1>

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
    <label for="nombre"> nombre</label>
    <input type="text" class="form-control" name="nombre"
        value="{{ isset($trabajador->persona->nombre) ? $trabajador->persona->nombre : old('nombre') }}" id="nombre">
</div>

<div class="form-group">
    <label for="apellidos"> apellidos</label>
    <input type="text" class="form-control" name="apellidos"
        value="{{ isset($trabajador->persona->apellidos) ? $trabajador->persona->apellidos : old('apellidos') }}" id="apellidos">

</div>

<div class="form-group">
    <label for="telefono"> telefono</label>
    <input type="text" class="form-control" name="telefono"
        value="{{ isset($trabajador->persona->telefono) ? $trabajador->persona->telefono : old('telefono') }}" id="telefono">

</div>

<div class="form-group">
    <label for="correo"> correo</label>
    <input type="text" class="form-control" name="correo"
        value="{{ isset($trabajador->persona->correo) ? $trabajador->persona->correo : old('correo') }}" id="correo">

</div>


<div class="form-group">
    <label for="cargo"> cargo</label>
    <input type="text" class="form-control" name="cargo"
        value="{{ isset($trabajador->cargo) ? $trabajador->cargo : old('cargo') }}" id="cargo">

</div>

<div class="form-group">
    <label for="foto"></label>
    @if (isset($trabajador->persona->foto))
        <img class="img-thumbnail img-fluid" style="height:250px;width:300px" src="{{ asset('storage') . '/' . $trabajador->persona->foto }}" alt="">
    @endif
    <input type="file" class="form-control" name="foto" value="" id="foto">
    <br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} Datos">

<a class="btn btn-primary" href="{{ url('trabajador') }}">Regresar</a>
