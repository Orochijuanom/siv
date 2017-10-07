<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Oportunidade; 
use App\Negocio; 
 
class OportunidadesController extends Controller 
{ 
    public function index(Request $request){ 
        return view('oportunidades.index'); 
    } 
 
    public function storeOportunidades(Request $request){ 
        $this->validate($request, [             
            'solicitante' => 'required', 
            'email' => 'required', 
            'negocio' => 'required',  
            'empresa' => 'required', 
            'telefono' => 'required', 
            'nit' => 'required',  
            'descripcion' => 'required', 
            'cargo' => 'required', 
            'fecha' => 'required', 
            'presupuesto' => 'required'             
        ]); 
 
         
        try{ 
                $nit = $request->nit."-".$request->dig; 
                $oportunidades = Oportunidade::Create([ 
                    'solicitante' => $request->solicitante, 
                    'email' => $request->email, 
                    'negocio_id' => $request->negocio, 
                    'telefono' => $request->telefono, 
                    'empresa' => $request->empresa, 
                    'nit' => $nit, 
                    'descripcion' => $request->descripcion, 
                    'cargo' => $request->cargo, 
                    'fecha_requerida' => $request->fecha, 
                    'presupuesto' => $request->presupuesto 
 
                ]); 
 
                return response(['data' => 'exito'], 200); 
             
        }catch(\Exception $e){ 
            return response(['data' => $e->getMessage()], 401);  
        } 
    } 
} 