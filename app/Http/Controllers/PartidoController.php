<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $listaPartido = Partido::with("equipo")->get();

        $listaPartido = Partido::all();
        return $listaPartido;
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

    public function curso(){
        $listaPartido = Partido::where("estado","=","1")->get();
        return $listaPartido;

    }
    public function terminados(){
        $listaPartido = Partido::where("estado","=","0")->get();
        return $listaPartido;
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
            "equipo1_id"          => "required|numeric",
            "equipo2_id"          => "required|numeric",
            "inicio"              => "required",
            "final"               => "required",
            "marcador_equipo1"    => "required|numeric",
            "marcador_equipo2"    => "required|numeric",
            "estado"              => "required",

        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
//        dd($request->all());
        $partido = new Partido();
        $partido->fill($request->all());
        $partido->save();

        return $partido;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objPartido = Partido::find($id);
        if ($objPartido == null) {
            return response()->json(['error' => 'No se encuentra el partido'], Response::HTTP_NOT_FOUND);
        }

        return $objPartido;
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
        $objPartido = Partido::find($id);
        if ($objPartido == null) {
            return response()->json(['error' => 'No se encuentra el partido'], Response::HTTP_NOT_FOUND);
        }
        $validated = Validator::make($request->json()->all(), [
            "equipo1_id"          => "required|numeric",
            "equipo2_id"          => "required|numeric",
            "inicio"              => "required",
            "final"               => "required",
            "marcador_equipo1"    => "required|numeric",
            "marcador_equipo2"    => "required|numeric",
            "estado"              => "required",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
        $objPartido->fill($request->all());
        $objPartido->save();

        return $objPartido;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objPartido = Partido::find($id);
        if ($objPartido == null) {
            return response()->json(['error' => 'No se encuentra el partido'], Response::HTTP_NOT_FOUND);
        }
        $objPartido->delete();

        return response()->json(['message' => 'Partido eliminado']);
    }
}
