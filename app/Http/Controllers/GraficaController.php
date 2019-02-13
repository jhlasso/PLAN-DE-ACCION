<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PlanDeAccion\app\Http\Requests;
use App\Actividad;
use App\ActividadResponsable;
use App\ActividadMeta;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ActividadFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class GraficaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request)
    {
    	 if($request)
        {
        	 $query = trim($request->get('searchText'));
            $actividades=DB::table('actividad as ac')
            ->join('objetivo as ob','ac.objetivo_id','=','ob.id')
            ->join('actividad_responsable as ar','ac.id','=','ar.actividad_id')
            ->join('responsable as r','ar.responsable_id','=','r.id')
            ->join('actividad_meta as am','ac.id','=','am.actividad_id')
            ->join('meta as m','am.meta_id','=','m.id')
            ->select('ac.id','ac.nombre','ac.estado','ac.indicador','ac.tipo','m.meta','m.fecha as miFecha','ac.presupuesto','ob.nombre as objetivos','r.nombre as nr','ar.id as acre','m.cumplido')
            ->where('ac.nombre','LIKE','%'.$query.'%')
            ->orderBy('ac.id','desc')
            ->paginate(7);

         
       


            return view('plandeaccion.graficas.index',["actividades"=>$actividades]);
        }
    }
}
