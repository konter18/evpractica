<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Cliente;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Cliente::with('persona')
        ->paginate(10);

    return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                //campos a validar
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|integer|max:999999999',
            'correo' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
            'rut' => 'required|string|max:100',
            'direccion' => 'required|string|max:100'

        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);
        $datosCLientes = request()->except('_token', 'rut','direccion');

        if ($request->hasfile('foto')) {
            $datosCLientes['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        $persona = Persona::firstOrCreate($datosCLientes);

        Cliente::firstOrCreate([
            'rut' => request('rut'),
            'direccion' => request ('direccion'),
            'personas_id' => $persona->id
        ]);

        return redirect('clientes')->with('mensaje', 'Cliente agregado con exito');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|integer|max:999999999',
            'correo' => 'required|email',
            'rut' => 'required|string|max:100',
            'direccion' => 'required|string|max:100'
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',

        ];

        if ($request->hasfile('foto')) {
            $campos = ['foto' => 'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje = ['foto.required' => 'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        //
        $datosCLientes = request()->except(['_token', '_method']);
        $cliente = Cliente::findOrFail($id);
        $persona = Persona::findOrFail($cliente->personas_id);
        if ($request->hasfile('foto')) {
            Storage::delete('public/' . $persona->foto);
            $datosCLientes['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        $persona->update($datosCLientes);
        $cliente->update(['rut' => request('rut')]);
        $cliente->update(['direccion' => request('direccion')]);

        //return view('trabajador.edit',compact('trabajador') );
        return redirect('clientes')->with('mensaje', 'Cliente modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cliente = Cliente::findOrFail($id); // Busca el TRABAJADOR a eliminar 
        $persona = Persona::findOrFail($cliente->personas_id); // busca la persona correspondiente al TRABAJADOR (NOMBRE APELLIDO FOTO)
        $cliente->delete(); // ELIMINAMOS EL TRABAJADOR

        if(!Cliente::where('personas_id', $persona->id)->exists()){
            if (Storage::delete('public/' . $persona->foto)) {
                $persona->delete();
            }
        }
        return redirect('clientes')->with('mensaje', 'Trabajador borrado');
    }
}
