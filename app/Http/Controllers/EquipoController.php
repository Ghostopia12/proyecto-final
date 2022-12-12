<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Puntuacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaEquipos = Equipo::with("grupo")->get();//, traer mas
        return $listaEquipos;
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

    public function grupos($id){
        $listaEquipos = Equipo::where("grupo_id","=","%$id%")->get();//, traer mas
        return $listaEquipos;
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
            "nombre"                    => "required",
            "grupo_id"                  => "required|numeric",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
//        dd($request->all());
        $equipo = new Equipo();
//        $puntuacion = new Puntuacion();
        $equipo->fill($request->all());
//        $puntuacion->nombre_equipo = $request->nombre;
//        $puntuacion->partidos_ganados = 0;
//        $puntuacion->partidos_perdidos = 0;
//        $puntuacion->partidos_empatados = 0;
//        $puntuacion->partidos_jugamos = 0;
//        $puntuacion->goles_favor = 0;
//        $puntuacion->goles_contra = 0;
//        $puntuacion->puntos = 0;
//        $puntuacion->save();
        $equipo->save();

        return $equipo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objEquipo = Equipo::find($id);
        if ($objEquipo == null) {
            return response()->json(['error' => 'No se encuentra el equipo'], Response::HTTP_NOT_FOUND);
        }

        return $objEquipo;
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
        $objEquipo = Equipo::find($id);
        if ($objEquipo == null) {
            return response()->json(['error' => 'No se encuentra el equipo'], Response::HTTP_NOT_FOUND);
        }
        $validated = Validator::make($request->json()->all(), [
            "nombre"                    => "required",
            "grupo_id"                  => "required|numeric",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
        $objEquipo->fill($request->all());
        $objEquipo->save();

        return $objEquipo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objEquipo = Equipo::find($id);
        if ($objEquipo == null) {
            return response()->json(['error' => 'No se encuentra el equipo'], Response::HTTP_NOT_FOUND);
        }
        $objEquipo->delete();

        return response()->json(['message' => 'Equipo eliminado']);
    }
    public function uploadPhoto(Request $request, $id)
    {
        $objEquipo = Equipo::find($id);
        if ($objEquipo == null) {
            return response()->json(['error' => 'No se encuentra el equipo'], Response::HTTP_NOT_FOUND);
        }
        $validated = Validator::make($request->all(), [
            "foto" => "required|image",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
        $file     = $request->file("foto");
//        $uuidName = Str::uuid()->toString();
//        $name     = "$uuidName.".$file->getClientOriginalExtension();
        $name = "$id.".'jpg';
        $file->move(public_path("images"), $name);
//        $objEquipo->imagen = $name;
        $objEquipo->save();

        return $objEquipo;
    }
}
