<?php

namespace App\Http\Controllers;

use stdClass;
use Exception;
use Mike42\Escpos\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use PhpParser\Node\Stmt\TryCatch;

class VentasController extends Controller
{

    public function index()
    {
        try{
           
            $listaventas = Session::get('listaventas', []);
            
            return view('Ventas', compact('listaventas'));

        } catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
    }

    public function anadiracesta(Request $request)
    {
        try {
            $buscarproducto = DB::connection('mysql')->table('Productos')->select('*')->where('Codigo',$request->anadir)->first();    
        $listaventas = Session::get('listaventas', []);

        if ($buscarproducto) {
            $producto_existente_key = null;

            foreach ($listaventas as $key => $producto) {
                if ($producto->Codigo === $buscarproducto->Codigo) {
                    $producto_existente_key = $key;
                    break;
                }
            }
            
            // Si el producto no está en la lista, agregarlo
            if ($producto_existente_key === null) {
                $productoañadido = new stdClass();
                $productoañadido->id = $buscarproducto->id;
                $productoañadido->Nombre = $buscarproducto->Nombre;
                $productoañadido->Codigo = $buscarproducto->Codigo;
                $productoañadido->PT = $buscarproducto->PT;
                $productoañadido->CantidadAlmacen = $buscarproducto->Cantidad;
                $productoañadido->Cantidad = 1;
                $productoañadido->PTT = number_format($productoañadido->PT * $productoañadido->Cantidad, 2);

                $listaventas[] = $productoañadido;
            } else {
                // Si el producto está en la lista, incrementar la cantidad en 1
                $listaventas[$producto_existente_key]->Cantidad++;
                $listaventas[$producto_existente_key]->PTT = $listaventas[$producto_existente_key]->PT * $listaventas[$producto_existente_key]->Cantidad;
            }

            Session::put('listaventas', $listaventas);
            return redirect('/Ventas')->with('anadido','Producto añadido con exito');

        } else {
            return redirect('/Ventas')->with('noencontrado','El producto no se ha encontrado');
        }
        } catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
        
    }

    public function cancelarVenta()
    {
        try {

            $listaventas = [];
            Session::put('listaventas', $listaventas);
            return redirect('/Ventas'); 

        } catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
        
    }

    public function eliminardelista($id)
    {
        try {
            $listaventas = Session::get('listaventas', []);

            
            foreach ($listaventas as $index => $producto) {
                if ($producto->id == $id) {
                    
                    unset($listaventas[$index]);
                    break; 
                }
            }

            
            $listaventas = array_values($listaventas);

            
            Session::put('listaventas', $listaventas);

            return redirect('/Ventas');

        } catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
        
    }

    public function actualizarCantidadVenta(Request $request,$codigo)
    {
        try {
            $listaventas = Session::get('listaventas', []);
        
            $action = $request->input('action');
            
            
            if($action === 'arriba'){
                
                foreach ($listaventas as $producto) {
                    if ($producto->Codigo == $codigo) {
                        
                        $producto->Cantidad = $producto->Cantidad + 1;
                        $producto->PTT = $producto->PT * $producto->Cantidad;
                    }
                }
                
            }
            
            if($action === 'abajo'){
                foreach ($listaventas as $producto) {
                    if ($producto->Codigo == $codigo) {
                        
                        $producto->Cantidad = $producto->Cantidad - 1;
                        $producto->PTT = $producto->PT * $producto->Cantidad;
                    }
                }
            }


            return redirect('/Ventas');
        } catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
        
    }

    public function finalizarVenta(Request $request)
    {
        
        try{
        
        $diadetrabajo = Session::get('filaidatrabajar');
        $listaventas = Session::get('listaventas', []);
        Session::put('ultimoticket', $listaventas);

        date_default_timezone_set('Europe/Madrid');
        $horaActual = date('H:i'); 
        $horaInicio = '06:00';
        $horaFin = '15:00';
    
        
        
        
        if ($horaActual >= $horaInicio && $horaActual <= $horaFin) {

            // Realizar acciones si la hora actual está entre 8:00 y 15:00
            
            $dineroactualBD = DB::connection('mysql')->table('InformesDiarios')->select('Manana')->where('id', $diadetrabajo)->first();
            
            $dineroactual = $dineroactualBD->Manana;
            $actualizardinero = $dineroactual + $request->totalAPagar;
               
            DB::connection('mysql')->table('InformesDiarios')->where('id', $diadetrabajo)->update([
                    'Manana' => $actualizardinero,
            ]);

            
            foreach($listaventas as $producto) {
                $numTtotalproductoBD = DB::connection('mysql')
                    ->table('Productos')
                    ->select('Cantidad')
                    ->where('id', $producto->id)
                    ->value('Cantidad');
                
                $cantidadArestar = $producto->Cantidad;
                
                $cantidadfinal = $numTtotalproductoBD - $cantidadArestar;
                
                
                DB::connection('mysql')
                    ->table('Productos')
                    ->where('id', $producto->id)
                    ->update([
                        'Cantidad' => $cantidadfinal,
                    ]);
            }

        } else {
            
            // Realizar acciones si la hora actual está fuera del rango de 8:00 a 15:00
            $dineroactual = DB::connection('mysql')->table('InformesDiarios')->select('Tarde')->where('id', $diadetrabajo)->first();
            
            $dineroactual = $dineroactual->Tarde; // Obtenemos el valor real de la columna 'tarde'
            $actualizardinero = $dineroactual + $request->totalAPagar;
                   
            DB::connection('mysql')->table('InformesDiarios')->where('id', $diadetrabajo)->update([
                    'Tarde' => $actualizardinero,
                ]);
            
            foreach($listaventas as $producto) {
                    $numTtotalproductoBD = DB::connection('mysql')
                        ->table('Productos')
                        ->select('Cantidad')
                        ->where('id', $producto->id)
                        ->value('Cantidad');
                    
                    $cantidadArestar = $producto->Cantidad;
                    
                    $cantidadfinal = $numTtotalproductoBD - $cantidadArestar;
                    
                    
                    DB::connection('mysql')
                        ->table('Productos')
                        ->where('id', $producto->id)
                        ->update([
                            'Cantidad' => $cantidadfinal,
                        ]);
                }

        }
        
        $mesActual = date('Y-n');
        

        foreach ($listaventas as $venta) {
            
            DB::connection('mysql')
                ->table('HistorialVentaProductos')
                ->where('Fecha', $mesActual)
                ->where('Codigo', $venta->Codigo)
                ->increment('Cantidad', $venta->Cantidad);

        }

        $opcionticket = $request->ticket;
        if ($opcionticket == "ticketsi") {
            $this->imprimir();
        }
        
        
        

        $this->cancelarVenta();
        return redirect('/Ventas');

        }catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
    }


    public function imprimir()
    {
        try {
            // Obtener la fecha y hora actual en España
            $fechaHora = now()->setTimezone('Europe/Madrid')->format('d/m/Y H:i:s');
        
            // Obtener el ultimo ticket
            $ultimoticket = Session::get('ultimoticket', []);
        
            // Nombre de la Tienda
            $nombreTienda = "Tienda";
            
            // Crear el contenido del ticket
            $cabecera = "$nombreTienda\n";
            $cabecera .= "$fechaHora\n";
            $cabecera .= "Ubicacion\n";
            $cabecera .= "\nFactura Simplificada\n\n";
        
            $cabecera .= "Venta\n\n";
            
            // Zona Central de Columnas (Tabla)
            $centro = "Producto           Cantidad     Precio     Total\n";
            
            foreach ($ultimoticket as $venta) {
                $nombreProducto = substr($venta->Nombre,0,16);
                $cantidad = $venta->Cantidad;
                $precioUnitario = number_format($venta->PT, 2);
                $precioTotal = number_format($venta->PTT, 2);

                $centro .= str_pad($nombreProducto, 20) . str_pad($cantidad, 10) . str_pad($precioUnitario, 10) . "$precioTotal\n";
            }

            $centro .= "\nTOTAL(EUR) IVA incluido:  ";
            
            // Calcular el total de la compra
            $totalCompra = array_reduce($ultimoticket, function ($carry, $venta) {
                return $carry + ($venta->Cantidad * $venta->PT); 
            }, 0);
            
            $totalCompraFormateado = number_format($totalCompra, 2);

            $centro .= str_pad("$totalCompraFormateado ", 40) . "\n"; 
        

            $pie = "\n\nGracias por su visita\n";
            $pie .= "\nVuelva pronto\n\n";


            // Imprimir el contenido del ticket
            $nombreImpresora = "POS-80";
            $connector = new WindowsPrintConnector($nombreImpresora);
            $printer = new Printer($connector);

            //cabecera
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(1, 1);
            $printer->text($cabecera);

            //centro
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(1, 1);
            $printer->text($centro);

            //pie
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(1, 1);
            $printer->text($pie);

            $printer->cut();
            $printer->feed(3);
            $printer->close();

            return redirect('/Ventas');
        }  catch (Exception $e) {
            error_log('Ocurrio un error: ' . $e->getMessage(), 0);
            return redirect('inicio')->with('Error', 'Ha ocurrido un error');
        }
        
    }

    
}
