<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Curso;

class UsuariosController extends Controller
{
    public function registrar(Request $req){

    	$respuesta = ["status" => 1, "msg" => ""];
    	
    	$datos = $req->getContent();

    	$datos = json_decode($datos); 

    	$usuario = new Usuario();

    	$usuario->nombre = $datos->nombre;
    	$usuario->foto = $datos->foto;
    	$usuario->email = $datos->email;
    	$usuario->contraseña = $datos->contraseña;
    	$usuario->activo = $datos->activo = 1;

        if(isset($datos->email))
            $usuario->email = $datos->email;

    	try{
            if (Usuario::where('email', '=', $datos->email)->first()) {
                $respuesta['msg'] = "Este email ya ha sido utilizado por otro usuario";
            }else{
    		$usuario->save();
    		$respuesta['msg'] = "Usuario guardado con id ".$usuario->id;
            }
    	}catch(\Exception $e){
    		$respuesta['status'] = 0;
    		$respuesta['msg'] = "Se ha producido un error ".$e->getMessage();
    	}
    	
    	return response()->json($respuesta);

    }

    public function editar(Request $req,$id){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        $datos = json_decode($datos); 

        try{
            $usuario = Usuario::find($id);

            if($usuario){


                if(isset($datos->nombre))
                    $usuario->nombre = $datos->nombre;
                if(isset($datos->foto))
                    $usuario->foto = $datos->foto;
                if(isset($datos->contraseña))
                    $usuario->contraseña = $datos->contraseña;
                


               
                    $usuario->save();
                    $respuesta['msg'] = "Usuario actualizado.";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

      public function desactivar($id){

            $respuesta = ["status" => 1, "msg" => ""];

            try{
                $usuario = Usuario::find($id);


                if($usuario->activo = 1){
                        $respuesta['msg'] = "Usuario desactivado";
                        $usuario->activo = 0;
                        $usuario->save();

                }else if ($usuario->activo == 0){
                    $respuesta["msg"] = "El usuario ya esta desactivado";

                }else{
                    $respuesta["msg"] = "Usuario ya esta desactivado";
                    $respuesta["status"] = 0;

                }
            }catch(\Exception $e){
                $respuesta['status'] = 0;
                $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
            }

            return response()->json($respuesta);
        }

    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $usuarios = Usuario::all();
            $respuesta['datos'] = $usuarios;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function comprar_curso($usuarios_id, $cursos_id){

        $respuesta = ["status" => 1, "msg" => ""];

        try{
            $usuario = Usuario::find($usuarios_id);
            $curso = Curso::find($cursos_id);

                if($usuario&&$curso){

                $usuario->cursos()->attach($curso);
                $respuesta['msg'] = "El usuario ha adquirido el curso ".$curso->id;
                
                }else{
                    $respuesta['msg'] = "Ha habido un error al buscar el usuario o curso ";
                }

        }catch(\Exception $e){

                $respuesta['status'] = 0;
                $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
            
    }

    public function listar_usuario_curso($id){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $usuario = Usuario::find($id);
            $usuario->cursos;
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }
}
