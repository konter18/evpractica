@extends('layouts.app')

@section('content')
    <div class="container">


        @if (Session::has('mensaje'))
            <div class="alert alert-success" role="alert">

                {{ Session::get('mensaje') }}
            </div>
        @endif





        <a href="{{ url('trabajador/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
        <br>
        <br>
        <table class="table table-light">

            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>foto</th>
                    <th>nombre</th>
                    <th>apellidos</th>
                    <th>telefono</th>
                    <th>correo</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($trabajadores as $trabajador)
                    <tr>
                        <td>{{ $trabajador->persona->id }}</td>
                        <td>
                            <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $trabajador->persona->foto }}"
                                width="200" height="150" alt="">
                        </td>
                        <td>{{ $trabajador->persona->nombre }}</td>
                        <td>{{ $trabajador->persona->apellidos }}</td>
                        <td>{{ $trabajador->persona->telefono }}</td>
                        <td>{{ $trabajador->persona->correo }}</td>
                        <td>{{ $trabajador->cargo }}</td>
                        <td>
                            <a href="{{ url('/trabajador/' . $trabajador->persona->id . '/edit') }}" class="btn btn-warning">
                                Editar
                            </a>
                            |

                            <form action="{{ url('/trabajador/' . $trabajador->persona->id) }}" class="d-inline"
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
