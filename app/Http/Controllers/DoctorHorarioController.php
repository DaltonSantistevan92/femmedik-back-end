<?php

namespace App\Http\Controllers;

use App\Models\Dias;
use App\Models\DoctorHorario;
use Illuminate\Http\Request;
use DateTime;

class DoctorHorarioController extends Controller
{
    public function generate(Request $request){
        try{
            $horarioRequest = (object)$request->horario;

            $h_entrada = $horarioRequest->h_entrada;
            $h_salida = $horarioRequest->h_salida;

            $intervalo = intval($horarioRequest->intervalo);
            $user_id = intval($horarioRequest->user_id);
            $doctor_id = intval($horarioRequest->doctor_id);
            $response = [];   $minHora = 60;

            if($intervalo > 0 && $intervalo <= $minHora){
                //obtener los dias de la semana 
                $dataDias = Dias::where('estado','A')->orderBy('orden','ASC')->get();

                //Dividir las horas
                $inicio = date('Y-m-d'). ' ' .$h_entrada;
                $fin = date('Y-m-d'). ' ' .$h_salida;

                //calcular las horas a repetir
                $horaInicio = new DateTime($inicio);
                $horaFin = new DateTime($fin);
                $diferencia = $horaInicio->diff($horaFin);
                $cantHoras = intval($diferencia->format('%H'));

                //calcular las veces de salto en el intervalo de horas (5,10,15,20,30,60)
                // 9:00 - 18:00 >> saltos o intervalos de 15 min >>  ejemplo 60 min / 15
                $cantidadTurnosxHora = intval($minHora / $intervalo);

                //Generar los tiempos
                $auxSalto = 0;   $resetDate = $inicio;

                if(count($dataDias) > 0){//existen dias
                    foreach($dataDias as $dia){
                        for ($i=0; $i < $cantHoras; $i++) {
                            for ($j=0; $j < $cantidadTurnosxHora; $j++) {
                                $nuevoInicio = strtotime('+ ' . $auxSalto . 'minute', strtotime($inicio));

                                $procesoFin = date('Y-m-d H:i:s', $nuevoInicio);

                                $nuevoFin = strtotime('+ ' . $intervalo . 'minute', strtotime($procesoFin));

                                 //validar la hora de almuerzo
                                $desde = intval(date('H',$nuevoInicio));
                                $hasta = intval(date('H',$nuevoFin));

                                if($desde != 12){
                                    $entrada = date('H:i:s', $nuevoInicio);
                                    $salida = date('H:i:s', $nuevoFin);
                                }

                                $auxSalto = $auxSalto + $intervalo;

                                //validar si existe el registro
                                $existeDoctorHorario = DoctorHorario::where('doctor_id',$doctor_id)
                                                    ->where('dia_id',$dia->id)
                                                    ->where('h_entrada',$entrada)
                                                    ->where('h_salida',$salida)->get()->first();

                                if($existeDoctorHorario){
                                    $response = [
                                        'status' => false,
                                        'mensaje' => 'El doctor ya tiene asignado su horario semanal',
                                        'doctor_horario' => []
                                    ];
                                }else{
                                    $nuevoDoctorHorario = new DoctorHorario();
                                    $nuevoDoctorHorario->dia_id = $dia->id;
                                    $nuevoDoctorHorario->doctor_id = $doctor_id;
                                    $nuevoDoctorHorario->user_id = $user_id;
                                    $nuevoDoctorHorario->h_entrada = $entrada;
                                    $nuevoDoctorHorario->h_salida = $salida;
                                    $nuevoDoctorHorario->libre = 'S';
                                    $nuevoDoctorHorario->estado = 'A';
                                    $nuevoDoctorHorario->save();
    
                                    $response = [
                                        'status' => true,
                                        'mensaje' => 'Se ha asignado su horario semanal',
                                        'doctor_horario' => $nuevoDoctorHorario
                                    ];
                                }  
        
                            }
                        }
                        $inicio = $resetDate;  $auxSalto = 0;
                    }
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'el intervalo debe ser de 1 min a 60 min',
                        'doctor_horario' => null
                    ];
                }
            }
            return response()->json($response,200);
        }catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    public function getHorario(){//sin utilizar
        try{
            $dataDoctorHorario = DoctorHorario::selectRaw("(doctor_horarios.id) AS doctorHorario_id, doctor_horarios.h_entrada, doctor_horarios.h_salida")
                                                ->selectRaw("(dias.dia) AS dias")
                                                ->join('dias','doctor_horarios.dia_id','=', 'dias.id')
                                                ->get();

            if(count($dataDoctorHorario) > 0){
                $coll = collect($dataDoctorHorario)->groupBy('dias');

                $response = [ 'horario' => $coll ];    
            }
            return response()->json($response);
        }catch (\Throwable $th) {
            $response = [ 'status' => false, 'message' => 'Error del Servidor' ];
            return response()->json( $response, 500 );
        }
    }

    /* public function getHorarioEvent(){
        $doctorHorario = DoctorHorario::where('doctor_id',1)->where('estado','A')->where('libre','A')->get(); 

        if(count($doctorHorario) > 0){
            for ($i=0; $i < count($doctorHorario) ; $i++) { 
                $objFecha[] = $doctorHorario[$i]->fecha;     
            }
        }
    } */
}
