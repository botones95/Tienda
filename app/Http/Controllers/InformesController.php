<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{
    //informes diarios
    public function showinformesDiarios()
    {
        $informesDiarios = DB::connection('mysql')->table('InformesDiarios')->select('*')->get();
        return view('InformesDiarios', compact('informesDiarios'));
    }

    public function showinformesPreciosProductos()
    {
        $informesPreciosProductos = DB::connection('mysql')->table('HistorialPreciosProductos')->select('*')->get();
        return view('InformesPreciosProductos', compact('informesPreciosProductos'));
    }

    public function showinformesVentaProductos()
    {
        $informesVentaProductos = DB::connection('mysql')->table('HistorialVentaProductos')->select('*')->get();
        return view('InformesVentaProductos', compact('informesVentaProductos'));
    }

    public function showinformesMeses()
    {
        $informesMeses = DB::table('informesDiarios')
            ->select(
                DB::raw('SUBSTRING(dia, 1, 7) as mes'), // Extrae 'año-mes'
                DB::raw('SUM(total) as total_sum')
            )
            ->groupBy(DB::raw('SUBSTRING(dia, 1, 7)'))
            ->get();
        
        return view('InformesMeses', compact('informesMeses'));
    }
}
