<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Oportunidade; 
use App\Negocio; 
use App\Cotizacione;
use App\Cotizadosproducto;

class OportunidadesController extends Controller 
{ 
    public function index($id)
    {
        $negocio = Negocio::findOrFail($id);           
        return view('noauth.oportunidades')->with('negocio', $negocio); 
    } 
 
    public function storeOportunidades(Request $request)
    {
        $this->validate($request, [             
            'solicitante' => 'required', 
            'email' => 'required|email', 
            'negocio' => 'required',  
            'cliente' => 'required', 
            'telefono' => 'required',  
            'descripcion' => 'required', 
            'cargo' => 'required', 
            'fecha' => 'required', 
            'presupuesto' => 'required|numeric',
            'moneda' => 'required'             
        ]); 
          
        try{             
            $oportunidades = Oportunidade::Create([ 
                'solicitante' => $request->solicitante, 
                'email' => $request->email, 
                'negocio_id' => $request->negocio, 
                'telefono' => $request->telefono, 
                'cliente_id' => $request->cliente, 
                'nit' => $request->nit, 
                'descripcion' => $request->descripcion, 
                'cargo' => $request->cargo, 
                'fecha_requerida' => $request->fecha, 
                'presupuesto' => $request->presupuesto,
                'moneda_id' => $request->moneda 
            ]); 
            return response(['data' => 'exito'], 200);              
        }catch(\Exception $e){ 
            return response(['data' => $e->getMessage()], 401);  
        } 
    } 


    public function crearCotizacion(Request $request)
    {
        try{ 
            $cotizacion = Cotizacione::Create([ 
                'oportunidade_id' => $request->oportunidade_id,
                'estado_id' => 1,
                'version' => $request->versionc,
                'descuento' => 0,
                'showdescuento' => '0'
            ]);
            if ($cotizacion){
                foreach($request->productos as $producto)
                {
                    Cotizadosproducto::create([
                        'stock_id' => $producto->stock_id, 
                        'valor' => $producto->valor, 
                        'cantidad' => $producto->cantidad,
                        'cotizacione_id' => $cotizacion->id, 
                        'fecha_entrega' => $producto->fecha_entrega, 
                        'negocio_id' => 1
                    ]);
                    
                }
            }

            return response(['data' => 'exito'], 200); 
        }catch(\Exception $e){ 
            return response(['data' => $e->getMessage()], 401);  
        }
}
} 