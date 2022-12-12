<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaGrupo = Grupo::with("equipos")->get();
        return $listaGrupo;
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
            "nombre"                    => "required",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
//        dd($request->all());
        $grupo = new Grupo();
        $grupo->fill($request->all());
        $grupo->save();

        return $grupo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objGrupo = Grupo::find($id);
        if ($objGrupo == null) {
            return response()->json(['error' => 'No se encuentra el grupo'], Response::HTTP_NOT_FOUND);
        }

        return $objGrupo;
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
        $objGrupo = Grupo::find($id);
        if ($objGrupo == null) {
            return response()->json(['error' => 'No se encuentra el grupo'], Response::HTTP_NOT_FOUND);
        }
        $validated = Validator::make($request->json()->all(), [
            "nombre"                    => "required",
        ]);
        if ( ! $validated) {
            return response()->json($validated->messages(), Response::HTTP_BAD_REQUEST);
        }
        $objGrupo->fill($request->all());
        $objGrupo->save();

        return $objGrupo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objGrupo = Grupo::find($id);
        if ($objGrupo == null) {
            return response()->json(['error' => 'No se encuentra el evento'], Response::HTTP_NOT_FOUND);
        }
        $objGrupo->delete();

        return response()->json(['message' => 'Grupo eliminado']);
    }
}
