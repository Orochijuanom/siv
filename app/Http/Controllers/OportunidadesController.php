<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Oportunidade; 
use App\Negocio; 
 
class OportunidadesController extends Controller 
{ 
    public function index($id){

        $negocio = Negocio::findOrFail($id);
           
        return view('noauth.oportunidades')->with('negocio', $negocio); 
    } 
 
    public function storeOportunidades(Request $request){ 
        $this->validate($request, [             
            'solicitante' => 'required', 
            'email' => 'required|email', 
            'negocio' => 'required',  
            'empresa' => 'required', 
            'telefono' => 'required', 
            'nit' => 'required',  
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
                'empresa' => $request->empresa, 
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
} 