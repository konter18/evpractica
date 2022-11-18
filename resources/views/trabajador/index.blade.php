@extends('layouts.app')

@section('content')
<div class="container">


        @if (Session::has('mensaje'))
            <div class="alert alert-success" role="alert">

                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <a href="{{ url('trabajador/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
        <br>
        <br>
        <table class="table table-light">

            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Cargo</th>
                    <th>>>>>Acciones<<<<</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($trabajadores as $trabajador)
                    <tr>
                        <td>{{ $trabajador->id }}</td>
                        <td>
                            <img style="height:150px;width:170px" class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $trabajador->persona->foto }}"
                             alt="">
                        </td>
                        <td>{{ $trabajador->persona->nombre }}</td>
                        <td>{{ $trabajador->persona->apellidos }}</td>
                        <td>{{ $trabajador->persona->telefono }}</td>
                        <td>{{ $trabajador->persona->correo }}</td>
                        <td>{{ $trabajador->cargo }}</td>
                        <td>
                            <a href="{{ url('/trabajador/' . $trabajador->id . '/edit') }}" class="btn btn-warning">
                                Editar
                            </a>
                            |

                            <form action="{{ url('/trabajador/' . $trabajador->id) }}" class="d-inline"
                                method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit" onclick=" return confirm('¿Quieres borrar?')"
                                    value="Borrar">
                            </form>


                        </td>
                    </tr>
                @endforeach( $trabajador as $trajadores)
            </tbody>
        </table>
        {!! $trabajadores->links() !!}
</div>
@endsection