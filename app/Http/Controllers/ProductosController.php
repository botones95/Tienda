<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ProductosController extends Controller
{
    public function index()
    {
        try{

            $productos = DB::connection('mysql')->table('Productos')->select('*')->get();    
            return view('Productos', compact('productos'));

        }catch(Exception $e){
            error_log('Error en la conexión a la base de datos: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('conexionBD', 'No se ha podido conectar con la base de datos');

        }
         
    }

    public function registrarProducto(Request $request)
    {
              
        try{
            
            $codigorepetido = DB::connection('mysql')->table('Productos')->select('Codigo')->where('Codigo',$request->codigo)->get(); 

            if ($codigorepetido->isEmpty()) {
                
                if (is_null($request->descripcion)) {
                    $request->descripcion = '';
                }

                DB::connection('mysql')->table('Productos')->insert([
                    'Nombre'=> $request->nombre,
                    'Descripcion' => $request->descripcion,
                    'Codigo' => $request->codigo,
                    'PVP'=> $request->pvp,
                    'Porciento'=> $request->porciento,
                    'PT' => $request->pt,
                    'Cantidad' => $request->cantidad,
                    'Proveedor' => $request->proveedor,
                ]);

                DB::connection('mysql')->table('HistorialPreciosProductos')->insert([
                    'Nombre'=> $request->nombre,
                    'Codigo' => $request->codigo,
                    'Fecha' => now(),
                    'PVP'=> $request->pvp,
                    'Porciento'=> $request->porciento,
                    'PT' => $request->pt,
                    ]);

                $mesactual = date('Y-n');
                $listadodelmes = DB::connection('mysql')->table('HistorialVentaProductos')
                ->select('*')
                ->where('Fecha',$mesactual)
                ->where('Codigo',$request->codigo)->get();
    
                if($listadodelmes->isEmpty()){
                    DB::connection('mysql')->table('HistorialVentaProductos')->insert([
                        'Fecha'=> now()->format('Y-m'),
                        'Nombre' => $request->nombre,
                        'Codigo' => $request->codigo,
                        'Cantidad' => 0,
                            
                    ]);
                }
                
                return redirect('/Productos')->with('anadido', 'Nuevo producto registrado');

            } else {

                return redirect('/Productos')->with('repetido', 'Este producto ya esta registrado');
                
            }
            
        }catch(Exception $e){
            error_log('ocurrio un error' . $e->getMessage(), 0);
            return redirect('inicio')->with('error', 'Ha ocurrido un error');
        }
        
    }

    public function edit(Request $request)
    {
        
        try {
            $productoId = $request->input('producto_id');
            
            $descripcion = is_null($request->Descripcion) ? '' : $request->Descripcion;
            
            
            DB::connection('mysql')->table('Productos')->where('id', $productoId)->update([
                'Nombre'=> $request->Nombre,
                'Descripcion' => $descripcion,
                'PVP'=> $request->PVP,
                'Porciento'=> $request->Porciento,
                'PT' => $request->PT,
                'Cantidad' => $request->Cantidad,
                'Proveedor' => $request->Proveedor,
            ]); 

            
            $codigoproducto = DB::connection('mysql')->table('Productos')->select('Codigo')->where('id',$productoId)->first();
            
            $preciosAntiguos = DB::connection('mysql')->table('HistorialPreciosProductos')->where('Codigo', $codigoproducto->Codigo)->latest('Fecha')->first();
            
            $nuevosValores = [
                'PVP' => $request->PVP,
                'Porciento' => $request->Porciento,
                'PT' => $request->PT,
            ];

            
           
            
            if ($preciosAntiguos->PVP != $nuevosValores['PVP'] || $preciosAntiguos->Porciento != $nuevosValores['Porciento'] || $preciosAntiguos->PT != $nuevosValores['PT'] ) {
                
                    DB::connection('mysql')->table('HistorialPreciosProductos')->insert([
                        'Nombre' => $request->Nombre,
                        'Codigo' => $codigoproducto->Codigo,
                        'Fecha' => now(),
                        'PVP' => $request->PVP,
                        'Porciento' => $request->Porciento,
                        'PT' => $request->PT,
                    ]);
    
            }
 
        

            return redirect('/Productos')->with('edit','Informacion actualizada');
            
        }catch(Exception $e){
            error_log('ocurrio un error' . $e->getMessage(), 0);
            return redirect('inicio')->with('error', 'Ha ocurrido un error');
        }
        
    }

    public function delete($id){
        
        try{
            
            DB::connection('mysql')->table('Productos')->where('id', $id)->delete();
            return redirect('/Productos')->with('Eliminado','Datos Eliminados'); 

        }catch(Exception $e){

            error_log('ocurrio un error' . $e->getMessage(), 0);
            return redirect('inicio')->with('error', 'Ha ocurrido un error');

        }
        
    }

    public function aumentarStore(Request $request)
    {
        try {
            $productoId = $request->input('producto_id');
            $nuevaCantidad = $request->input('nuevaCantidad');

        
            DB::connection('mysql')->table('Productos')->where('id', $productoId)->increment('Cantidad', $nuevaCantidad);

            return redirect('/Productos')->with('aumentado','Cantidad aumentada');

        } catch (Exception $e) {
            error_log('ocurrio un error' . $e->getMessage(), 0);
            return redirect('inicio')->with('error', 'Ha ocurrido un error');
        }    
    

    }

    
    
}
