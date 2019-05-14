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
}
