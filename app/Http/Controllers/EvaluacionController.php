<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluacion;
use App\Profesor;
class EvaluacionController extends Controller
{
    public function insertar(Request $request){
        $rules = [
            'calificacion' => 'required',
            'fecha' => 'required',
            'id_profesor' => 'required|exists:profesor,id',
            'id_user' => 'required|exists:user,id',
            'id_curso' => 'required|exists:curso,id'
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
        $profesores = Profesor::get();
        $promedios = array();
        foreach ($profesores as $profesor) {
            $suma = Evaluacion::selectRaw('sum(calificacion) as suma')
            ->where('id_profesor',$profesor->id)
            ->get();
            $numero = Evaluacion::where('id_profesor',$profesor->id)
            ->count();
            $promedio = 0;
            if($numero>0)
                $promedio = $suma/$numero;
            array_push($promedios,['profesor'=>$profesor->nombre.' '.$profesor->ape_paterno,'promedio'=>$promedio,'id_profesor'=>$profesor->id]);
        }
        return $this->success($promedios);
    }

    public function promedioProfesor(Request $request){
        $profesor = Profesor::find($request->id);
        $suma = Evaluacion::selectRaw('sum(calificacion) as suma')
        ->where('id_profesor',$profesor->id)
        ->get();
        $numero = Evaluacion::where('id_profesor',$profesor->id)
        ->count();
        $promedio = 0;
        if($numero>0)
            $promedio = $suma/$numero;
        $promedios=['profesor'=>$profesor->nombre.' '.$profesor->ape_paterno,'promedio'=>$promedio,'id_profesor'=>$profesor->id];

        return $this->success($promedios);
    }

}
