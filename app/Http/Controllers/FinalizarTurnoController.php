<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FinalizarTurnoController extends Controller
{
    public function index()
    {
        try {
            
            $diadetrabajo = Session::get('filaidatrabajar');
            $manana = DB::connection('mysql')->table('InformesDiarios')->where('id', $diadetrabajo)->value('Manana');
            $tarde = DB::connection('mysql')->table('InformesDiarios')->where('id', $diadetrabajo)->value('Tarde');
            $total = $manana + $tarde;

            DB::connection('mysql')->table('InformesDiarios')->where('id', $diadetrabajo)->update([
                'Total' => $total,
            ]);
            
            $InformeDelDia = DB::connection('mysql')
            ->table('InformesDiarios')
            ->select('*')
            ->where('id', $diadetrabajo)
            ->get();


            return view('FinalizarTurno', compact('InformeDelDia'));
            
        }catch(Exception $e){
            error_log('ocurrio un error' . $e->getMessage(), 0);
            return redirect('inicio')->with('error', 'Ha ocurrido un error');
        }
        
    }
}
