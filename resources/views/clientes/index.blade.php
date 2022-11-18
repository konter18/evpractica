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


        


        <a href="{{ url('clientes/create') }}" class="btn btn-success">Registrar nuevo Cliente</a>
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
                    <th>Rut</th>
                    <th>Direccion</th>
                    <th>>>>>Acciones<<<<</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->persona->id }}</td>
                        <td>
                            <img style="height:150px;width:350px" class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $cliente->persona->foto }}"
                             alt="">
                        </td>
                        <td>{{ $cliente->persona->nombre }}</td>
                        <td>{{ $cliente->persona->apellidos }}</td>
                        <td>{{ $cliente->persona->telefono }}</td>
                        <td>{{ $cliente->persona->correo }}</td>
                        <td>{{ $cliente->rut }}</td>
                        <td>{{ $cliente->direccion}}</td>
                        <td>
                            <a href="{{ url('/clientes/' . $cliente->id . '/edit') }}" class="btn btn-warning">
                                Editar
                            </a>
                            |

                            <form action="{{ url('/clientes/' . $cliente->id) }}" class="d-inline"
                                method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit" onclick=" return confirm('¿Quieres borrar?')"
                                    value="Borrar">
                            </form>


                        </td>
                    </tr>
                @endforeach( $clientes as $cliente)
            </tbody>
        </table>
        {!! $clientes->links() !!}
    </div>
@endsection
