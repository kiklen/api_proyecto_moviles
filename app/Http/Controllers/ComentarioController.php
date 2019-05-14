<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
class ComentarioController extends Controller
{
    public function insertar(Request $request){
        $rules = [
            'texto' => 'required',
            'fecha' => 'required',
            'id_profesor' => 'required|exists:profesor,id'
        ];
        $datos = $request->all();
        $errores = $this->validate($datos,$rules);
        if(count($errores)>0){
            return $this->error($errores);
        }
        $comentario = Comentario::create($datos);
        return $this->success($comentario);
    }
    public function actualizar(Request $request){
        $array = $request->all();
        $data = Comentario::find($request->id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        $data->update($array);
        return $this->success($data);
    }
    public function eliminar($id){
        $data = Comentario::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }

        $data->delete();
        return $this->succes(["objeto eliminado correctamente"]);
    }
    public function listar(){
        $data = Comentario::get();
        return $this->success($data);
    }
    public function mostrar($id){
        $data = Comentario::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        return $this->success($data);
    }

    public function obtenerComentarios(Request $request){
        $profesores= Profesor::get();
        $comentarios = array();
        foreach($profesores as $profesor) {
            $comentario = Comentario::where('id_profesor',$profesor->id)->get();
            array_push($promedios,['profesor'=>$profesor->nombre.' '.$profesor->ape_paterno,'comentario'=>$comentario,'id_profesor'=>$profesor->id]);
        }
        return $this->success($comentarios);
    }

    public function obtenerComentariosPorProfesor(Request $request){
        $comentario = Comentario::where('id_profesor',$request->id)->get();
        $comentarios = ['profesor'=>$profesor->nombre.' '.$profesor->ape_paterno,'comentario'=>$comentario,'id_profesor'=>$profesor->id];
        return $this->success($comentarios);
    }
}
