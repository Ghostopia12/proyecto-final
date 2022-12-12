<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaEventos = Evento::all();
        return $listaEventos;
    }

    public function especif($partido,$equipo){
        $listaEventos = Evento::where("partido_id","=","%$partido%","AND","equipo_id","=","%$equipo%");
        return $listaEventos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->json()->all(), [
            "partido_id"     => "required|numeric",
            "equipo_id"      => "required|numeric",
            "minuto"         => "required|numeric",
            "descripcion"    => "required",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
//        dd($request->all());
        $evento = new Evento();
        $evento->fill($request->all());
        $evento->save();

        return $evento;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objEvento = Evento::find($id);
        if ($objEvento == null) {
            return response()->json(['error' => 'No se encuentra el evento'], Response::HTTP_NOT_FOUND);
        }

        return $objEvento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $objEvento = Evento::find($id);
        if ($objEvento == null) {
            return response()->json(['error' => 'No se encuentra el evento'], Response::HTTP_NOT_FOUND);
        }
        $validated = Validator::make($request->json()->all(), [
            "partido_id"     => "required|numeric",
            "equipo_id"      => "required|numeric",
            "minuto"         => "required|numeric",
            "descripcion"    => "required",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
        $objEvento->fill($request->all());
        $objEvento->save();

        return $objEvento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objEvento = Evento::find($id);
        if ($objEvento == null) {
            return response()->json(['error' => 'No se encuentra el evento'], Response::HTTP_NOT_FOUND);
        }
        $objEvento->delete();

        return response()->json(['message' => 'Evento eliminado']);
    }
}
