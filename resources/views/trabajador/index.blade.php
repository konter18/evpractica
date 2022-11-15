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
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($trabajadores as $trabajador)
                    <tr>
                        <td>{{ $trabajador->persona->id }}</td>
                        <td>
                            <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $trabajador->persona->Foto }}"
                                width="200" height="150" alt="">
                        </td>
                        <td>{{ $trabajador->persona->Nombre }}</td>
                        <td>{{ $trabajador->persona->Apellidos }}</td>
                        <td>{{ $trabajador->persona->Telefono }}</td>
                        <td>{{ $trabajador->persona->Correo }}</td>
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
