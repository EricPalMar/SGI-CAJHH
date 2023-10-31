<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use Illuminate\Support\Facades\Redirect;

use App\Http\Request\UsuarioFormRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');

    }

    public function index()
        {
            $usuario=Usuario::orderBy('id','ASC')->paginate(10);

            return view('usuario.index',compact('usuario'));
        }        
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return view ('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioFormRequest $request)
    {
        $usuarios=new Usuario;
        $usuarios->documento_identidad=$request->get('documento_identidad');
        $usuarios->nombres=$request->get('nombres');
        $usuarios->apellidos=$request->get('apellidos');
        $usuarios->correo=$request->get('correo');
        $usuarios->telefono=$request->get('telefono');
        $usuarios->save();
        return Redirect::to('usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario=Usuario::findOrFail($id);
        return view("usuario.edit",["usuario"=>$usuario]);
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
        $usuarios=Usuario::findOrFail($id);
        $usuarios->documento_identidad=$request->get('documento_identidad');
        $usuarios->nombres=$request->get('nombres');
        $usuarios->apellidos=$request->get('apellidos');
        $usuarios->correo=$request->get('correo');
        $usuarios->telefono=$request->get('telefono');
        $usuarios->update();
         return Redirect::to('usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios=Usuario::findOrFail($id);
        $usuarios->delete();
        return Redirect::to('usuario');
    }
}
