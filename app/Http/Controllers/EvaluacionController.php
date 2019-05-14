<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluacion;
class EvaluacionController extends Controller
{
    public function insertar(Request $request){
        $rules = [
            'calificacion' => 'required',
            'fecha' => 'required',
            'id_profesor' => 'required|exists:profesor,id'
        ];
        $datos = $request->all();
        $errores = $this->validate($datos,$rules);
        if(count($errores)>0){
            return $this->error($errores);
        }
        $evaluacion = Evaluacion::create($datos);
        return $this->success($evaluacion);
    }
    public function actualizar(Request $request){
        $array = $request->all();
        $data = Evaluacion::find($request->id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        $data->update($array);
        return $this->success($data);
    }
    public function eliminar($id){
        $data = Evaluacion::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }

        $data->delete();
        return $this->succes(["objeto eliminado correctamente"]);
    }
    public function listar(){
        $data = Evaluacion::get();
        return $this->success($data);
    }
    public function mostrar($id){
        $data = Evaluacion::find($id);
        if(!$data) {
            return $this->error(["Objeto no encontrado"]);
        }
        return $this->success($data);
    }

    public function promedioProfesores(Request $request){
        $promedio = Evaluacion::join('profesor','id_profesor','=','profesor.id')
        ->where();

    }
}
