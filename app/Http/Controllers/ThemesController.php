<?php

namespace App\Http\Controllers;

use App\Models\Themes;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function show(Themes $themes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // si puede editar un curso entonces puede actualizar un tema
        $theme = Themes::find($id);
        if($theme){
            $theme->update($request->all());
            return response()->json([
                'message' => "Tema editado",
                'code' => 2
            ], 200);
        }
        return response()->json([
            'message' => "No se  editado",
            'code' => 2
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //si puede editar un curso entonces puede eliminar un tema
        $theme = Themes::find($id);
        if($theme){
            $theme->delete();
            return response()->json([
                'message' => "Se eliminó el tema",
                'code' => 2
            ], 200);
        }
    }
}
