<?php

namespace App\Http\Controllers;

use App\Models\Puntuacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PuntacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaPuntuaciones = Puntuacion::with("equipo")->get();
        //$listaPuntuaciones = Puntuacion::all();
        return $listaPuntuaciones;
    }

    public function especif($id)
    {
        $listaPuntuaciones = DB::select('call sp_tabla_punt_f(?)',array($id));
        return $listaPuntuaciones;
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
//        $validated = Validator::make($request->json()->all(), [
//            "id_equipo"                 => "required",
//            "partidos_ganados"          => "required|numeric",
//            "partidos_perdidos"         => "required|numeric",
//            "partidos_empatados"        => "required|numeric",
//            "partidos_jugamos"          => "required|numeric",
//            "goles_favor"               => "required|numeric",
//            "goles_contra"              => "required|numeric",
//            "puntos"                    => "required|numeric",
//        ]);
//        if ( ! $validated) {
//            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
//        }
//        dd($request->all());
        $puntuacion = new Puntuacion();
        $puntuacion->fill($request->all());
        $puntuacion->save();

        return $puntuacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objPuntuacion = Puntuacion::find($id);
        if ($objPuntuacion == null) {
            return response()->json(['error' => 'No se encuentra la puntuacion'], Response::HTTP_NOT_FOUND);
        }

        return $objPuntuacion;
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
        $objPuntuacion = Puntuacion::find($id);
        if ($objPuntuacion == null) {
            return response()->json(['error' => 'No se encuentra la puntuacion'], Response::HTTP_NOT_FOUND);
        }
//        $validated = Validator::make($request->json()->all(), [
//            "id_equipo"             => "required",
//            "partidos_ganados"          => "required|numeric",
//            "partidos_perdidos"         => "required|numeric",
//            "partidos_empatados"        => "required|numeric",
//            "partidos_jugamos"          => "required|numeric",
//            "goles_favor"               => "required|numeric",
//            "goles_contra"              => "required|numeric",
//            "puntos"                    => "required|numeric",
//        ]);
//        if ( ! $validated) {
//            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
//        }
        $objPuntuacion->fill($request->all());
        $objPuntuacion->save();

        return $objPuntuacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objPuntuacion = Puntuacion::find($id);
        if ($objPuntuacion == null) {
            return response()->json(['error' => 'No se encuentra la puntacion'], Response::HTTP_NOT_FOUND);
        }
        $objPuntuacion->delete();

        return response()->json(['message' => 'Puntuacion eliminado']);
    }
}
