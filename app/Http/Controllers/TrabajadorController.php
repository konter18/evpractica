<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trabajadores = Trabajador::with('persona')
            ->paginate(10);

        return view('trabajador.index', compact('trabajadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('trabajador.create');
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
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);
        $datosTrabajador = request()->except('_token', 'cargo');

        if ($request->hasfile('foto')) {
            $datosTrabajador['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        $persona = Persona::firstOrCreate($datosTrabajador);

        Trabajador::firstOrCreate([
            'cargo' => request('cargo'),
            'personas_id' => $persona->id
        ]);

        return redirect('trabajador')->with('mensaje', 'Persona agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $trabajador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $trabajador = Trabajador::findOrFail($id);
        return view('trabajador.edit', compact('trabajador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validar datos
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|integer|max:999999999',
            'correo' => 'required|email',
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
        $datosTrabajador = request()->except(['_token', '_method']);
        $trabajador = Trabajador::findOrFail($id);
        $persona = Persona::findOrFail($trabajador->personas_id);
        if ($request->hasfile('foto')) {
            Storage::delete('public/' . $persona->foto);
            $datosTrabajador['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        $persona->update($datosTrabajador);
        $trabajador->update(['cargo' => request('cargo')]);
        //return view('trabajador.edit',compact('trabajador') );
        return redirect('trabajador')->with('mensaje', 'Persona modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $trabajador = Persona::findOrFail($id);

        if (Storage::delete('public/' . $trabajador->foto)) {
            Persona::destroy($id);
        }

        return redirect('trabajador')->with('mensaje', 'Persona borrado');
    }
}
