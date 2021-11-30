<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    public function crear(Request $req){

    	$respuesta = ["status" => 1, "msg" => ""];
    	
    	$datos = $req->getContent();

    	$datos = json_decode($datos); 

    	$curso = new Curso();

    	$curso->titulo = $datos->titulo;
    	$curso->descripcion = $datos->descripcion;
    	$curso->foto = $datos->foto;


    	try{
    		$curso->save();
    		$respuesta['msg'] = "Curso guardado con id ".$curso->id;

    	}catch(\Exception $e){
    		$respuesta['status'] = 0;
    		$respuesta['msg'] = "Se ha producido un error ".$e->getMessage();
    	}
    	
    	return response()->json($respuesta);
    }

    public function listar(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];
        $datos = $req-> getContent();
        $datos = json_decode($datos);                                                                                                                         
        try{

            $curso = DB::Table('curso');

            if ($req->has('titulo')) {
            $curso = Curso::withCount('videos as cantidad_videos')
            ->where('titulo', 'like', '%' .$req->input('titulo'). '%')
            ->get();
            $respuesta['datos'] = $curso;

        	} else {

        	$curso = Curso::withCount('videos as cantidad_videos')->get();
            $respuesta['datos'] = $curso;
        	}
            
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }
}
