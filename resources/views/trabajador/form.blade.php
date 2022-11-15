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
    <label for="Nombre"> Nombre</label>
    <input type="text" class="form-control" name="Nombre"
        value="{{ isset($trabajador->Nombre) ? $trabajador->Nombre : old('Nombre') }}" id="Nombre">
</div>

<div class="form-group">
    <label for="Apellidos"> Apellidos</label>
    <input type="text" class="form-control" name="Apellidos"
        value="{{ isset($trabajador->Apellidos) ? $trabajador->Apellidos : old('Apellidos') }}" id="Apellidos">

</div>

<div class="form-group">
    <label for="Telefono"> Telefono</label>
    <input type="text" class="form-control" name="Telefono"
        value="{{ isset($trabajador->Telefono) ? $trabajador->Telefono : old('Telefono') }}" id="Telefono">

</div>

<div class="form-group">
    <label for="Correo"> Correo</label>
    <input type="text" class="form-control" name="Correo"
        value="{{ isset($trabajador->Correo) ? $trabajador->Correo : old('Correo') }}" id="Correo">

</div>


<div class="form-group">
    <label for="Correo"> Cargo</label>
    <input type="text" class="form-control" name="Correo"
        value="{{ isset($trabajador->persona->car) ? $trabajador->persona->Correo : old('Correo') }}" id="Correo">

</div>

<div class="form-group">
    <label for="Foto"></label>
    @if (isset($trabajador->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $trabajador->Foto }}" alt="">
    @endif
    <input type="file" class="form-control" name="Foto" value="" id="Foto">
    <br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} Datos">

<a class="btn btn-primary" href="{{ url('trabajador') }}">Regresar</a>
