<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideosController extends Controller
{
    public function crear(Request $req){

    	$respuesta = ["status" => 1, "msg" => ""];
    	
    	$datos = $req->getContent();

    	$datos = json_decode($datos); 

    	$video = new Video();

    	$video->titulo = $datos->titulo;
    	$video->fotoPortada = $datos->fotoPortada;
    	$video->enlace = $datos->enlace;
    	$video->cursos_id = $datos->cursos_id;


    	try{
    		$video->save();
    		$respuesta['msg'] = "Video guardado con id ".$video->id;

    	}catch(\Exception $e){
    		$respuesta['status'] = 0;
    		$respuesta['msg'] = "Se ha producido un error ".$e->getMessage();
    	}
    	
    	return response()->json($respuesta);
    }
}
