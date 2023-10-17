<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IniciarDiaController extends Controller
{
    public function index(){
        // Establecer la zona horaria a 'Europe/Madrid' para obtener la hora española
        Carbon::setLocale('es');

        // Obtener la fecha y hora actual en la zona horaria especificada
        $fechaActual = Carbon::now('Europe/Madrid');

        
        // Obtener el nombre del mes en español
        $mes = $fechaActual->formatLocalized('%B');       // Nombre del mes (ej: "agosto")

        // Obtener el día del mes
        $dia = $fechaActual->format('d');                 // Día del mes (ej: "11")

        // Obtener el año
        $anio = $fechaActual->format('Y');                // Año (ej: "2023")

        // Obtener la hora y minutos en formato 24 horas
        $horaMinutos = $fechaActual->format('H:i');       // Hora y minutos (ej: "11:38")

        // Construir la cadena completa en español
        $fechaCompleta = "$dia de $mes de $anio, $horaMinutos";

        return view('IniciarDia',compact('fechaCompleta'));
    }

    public function ComprobarDia(Request $request)
    {
        try {
            $DiaActual = date('Y-m-d');
            $HoraActual = date('H:i');
            $buscariddia = DB::connection('mysql')->table('InformesDiarios')->select('id')->where('Dia', $DiaActual)->get();
            
            $ultimaMes = DB::table('HistorialVentaProductos')
                ->select('Fecha')
                ->latest('Fecha')
                ->first();
            
            $mesActual = date('Y-n');
            
            

            if ($ultimaMes->Fecha != $mesActual) {
                
                
                $listadoProductos = DB::connection('mysql')->table('Productos')->select('Nombre','Codigo')->get();

                foreach($listadoProductos as $producto){
                    DB::connection('mysql')->table('HistorialVentaProductos')->insert([
                        'Fecha' => now()->format('Y-m'),
                        'Nombre'=> $producto->Nombre,
                        'Codigo' => $producto->Codigo,
                        'Cantidad' => 0,
                        ]); 
                }
            }

            
            
            if ($buscariddia->isEmpty()) {//si no tenemos dia entramos en el if, de lo contrario iremos al else
                
                $idfila = DB::connection('mysql')->table('InformesDiarios')->insertGetId([
                    'Dia' => $DiaActual,
                    'Manana' => 0,
                    'Tarde' => 0,
                    'Total' => 0,
                ]);
                session(['filaidatrabajar' => $idfila]);
                return redirect('/inicio');
                
                
            } else {
                //logica si existe el dia iniciado
                $idEncontrado = $buscariddia->first();
                
                session(['filaidatrabajar' => $idEncontrado->id]);

                return redirect('/inicio');

            }
        } catch (Exception $e) {
            return redirect('/');
        }
        
        
    }

    public function showMenuInicial(){
        return view('Inicio');
    }
}
