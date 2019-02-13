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

class ActividadController extends Controller
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
            ->select('ac.id','ac.nombre','ac.estado','ac.indicador','ac.tipo','m.meta','m.fecha','ac.presupuesto','ob.nombre as objetivos','r.nombre as nr','am.id as acre')
            ->where('ob.nombre','LIKE','%'.$query.'%')
            ->orderBy('ac.id','desc')
            ->paginate(7);

           $responsables=DB::table('actividad_responsable as ar')
        ->join('responsable as r','ar.responsable_id','=','r.id')
        ->join('actividad as ac','ar.actividad_id','=','ac.id')
        ->select('r.nombre as responsable')
        ->where('actividad_id','=','ac.id')->get();

        $metas=DB::table('actividad_meta as am')
        ->join('meta as m','am.meta_id','=','m.id')
        ->join('actividad as ac','am.actividad_id','=','ac.id')
        ->select('m.nombre as meta')
        ->where('actividad_id','=','ac.id')->get();

        $id_act_res=DB::table('actividad_responsable as ar')
        ->join('actividad as ac','ar.actividad_id','=','ac.id')
        ->select('ar.actividad_id','ar.id')
        ->get();

        $objetivos=DB::table('objetivo as o')
            ->select('o.id','o.nombre')
            ->get();

            return view('plandeaccion.actividades.index',["actividades"=>$actividades,"searchText"=>$query,"responsables"=>$responsables,"id_act_res"=>$id_act_res,"metas"=>$metas,"objetivos"=>$objetivos]);
        }
        

    }

    public function create()
    {
        $objetivos=DB::table('objetivo')->get();
        $responsables=DB::table('responsable as res')
        ->select(DB::raw('CONCAT(" ",res.nombre) AS responsable'),'res.id')->get();
        $metas=DB::table('meta as met')
        ->select(DB::raw('CONCAT(" ",met.nombre) AS meta'),'met.id','met.fecha')->get();

        return view('plandeaccion.actividades.create',["objetivos"=>$objetivos,"responsables"=>$responsables,"metas"=>$metas]);

    }

    public function store(ActividadFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $actividad = new Actividad;
            $actividad->objetivo_id=$request->get('objetivo_id');
            $actividad->nombre = $request->get('nombreActividad');
            $actividad->estado = $request->get('estado');
            $actividad->indicador = $request->get('indicador');
            $actividad->tipo = $request->get('tipo');
            $actividad->presupuesto = $request->get('presupuesto');
            $actividad->save();

            $responsable_id = $request->get('idresponsables');

            $cont=0;

            while ($cont < count($responsable_id)) {
                $actres = new ActividadResponsable();
                $actres->actividad_id=$actividad->id;
                $actres->responsable_id=$responsable_id[$cont];
                $actres->save();
                $cont=$cont+1;
            }

            $meta_id = $request->get('idmetas');

            $cont1=0;

            while ($cont1 < count($meta_id)) {
                $met = new ActividadMeta();
                $met->actividad_id=$actividad->id;
                $met->meta_id=$meta_id[$cont1];
                $met->save();
                $cont1=$cont1+1;
            }

            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollback();
        }

        return Redirect::to('plandeaccion/actividades');
    }

    public function show($id)
    {
        $actividad=DB::table('actividad as ac')
            ->join('objetivo as ob','ac.objetivo_id','=','ob.id')
            ->join('actividad_responsable as ar','ac.id','=','ar.actividad_id')
            ->select('ac.nombre','ac.estado','ac.indicador','ac.tipo','ac.metas','ac.presupuesto','ac.fecha_inicio','ac.fecha_final')
            ->where('ac.id','=',$id)
            ->first();

        $actres=DB::table('actividad_responsable as ar')
        ->join('responsable as r','ar.responsable_id','=','r.id')
        ->select('r.nombre as responsable')
        ->where('ar.actividad_id','=',$id)->get();
        return view("plandeaccion.objetivos.show",["actividad"=>$actividad,"actres"=>$actres]);
    }

    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        $objetivos = DB::table('objetivo')->get();
        $actres = DB::table('actividad_responsable as ar')
        ->join('responsable as r','ar.responsable_id','=','r.id')
        ->select('ar.responsable_id','r.nombre','r.id as id_responsable' )
        ->where('ar.actividad_id','=',$id)->get();
       
        $responsables=DB::table('responsable as res')
        ->select(DB::raw('CONCAT(res.id," ",res.nombre) AS responsable'),'res.id')->get();

        return view("plandeaccion.actividades.edit",["actividad"=>$actividad,"objetivos"=>$objetivos,"actres"=>$actres,"responsables"=>$responsables]);
    }

    public function update(ActividadFormRequest $request, $id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->nombre=$request->get('nombreActividad');
        $actividad->estado=$request->get('estado');
        $actividad->indicador=$request->get('indicador');
        $actividad->tipo=$request->get('tipo');
        $actividad->presupuesto=$request->get('presupuesto');
        $actividad->objetivo_id=$request->get('objetivo_id');
        $actividad->update();

       


        return Redirect::to('plandeaccion/actividades');

    }

    public function destroy($acre)
    {
       
             ActividadMeta::destroy($acre);
                            ActividadResponsable::destroy($acre);
            return Redirect::to('plandeaccion/actividades');
       

    }
}
