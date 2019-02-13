<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PlanDeAccion\app\Http\Requests;
use App\Plan;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PlanFormRequest;
use DB;
use Carbon\Carbon;



class PlanDeAccionController extends Controller
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
            $planes=DB::table('plan')->where('id','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('plandeaccion.plan.index',["planes"=>$planes,"searchText"=>$query]);
        }
        

    }

    public function create()
    {
        return view('plandeaccion.plan.create');

    }

    public function store(PlanFormRequest $request)
    {
        $plan = new Plan;
        $plan->nombre = $request->get('nombrePlan');
        $plan->fecha_inicio = $request->get('fechaI');
        $plan->fecha_final = $request->get('fechaF');
        $plan->save();

        return Redirect::to('plandeaccion/plan');
    }

    public function show($id)
    {
        return view("plandeaccion.plan.show",["plan"=>Plan::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("plandeaccion.plan.edit",["plan"=>Plan::findOrFail($id)]);
    }

    public function update(PlanFormRequest $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->nombre=$request->get('nombrePlan');
        $plan->fecha_inicio=$request->get('fechaI');
        $plan->fecha_final=$request->get('fechaF');
        $plan->update();

        return Redirect::to('plandeaccion/plan');

    }

    public function destroy($id)
    {

        try
        {
            Plan::destroy($id);
            return Redirect::to('plandeaccion/plan');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return Redirect::to('plandeaccion/plan')->with('msj', 'El plan no se puede eliminar por que tiene objetivos asignados');
        }
                
    }

/**
//    public function create()
//    {
//        $planes = Plan::all();
//        return view('/plan',compact('planes'));
//  }
    public function storePlan(Request $request)
    {
        $this->validate($request,[
            'nombrePlan' => 'required',
        ]);

    	$plan = new Plan;
    	$plan->nombre = $request->input('nombrePlan');
        $plan->fecha_inicio = $request->input('fechaIPlan');
        $plan->fecha_final = $request->input('fechaFPlan');
    	$plan->save();

        return view('.plandeaccion.plan');

    }

    public function storeObjetivo(Request $request)
    {
        $this->validate($request,[
            'nombreObjetivo' => 'required',
            'plan_id' => 'required|numeric',

        ]);

    	$objetivo = new Objetivo;
    	$objetivo->nombre = $request->input('nombreObjetivo');
    	$objetivo->plan_id=$request->input('plan_id');
    	$objetivo->save();

    	return view('.plandeaccion.plan');

    }

    public function storeActividad(Request $request)
    {

        $this->validate($request,[
            'nombreActividad' => 'required',
            'indicador' => 'required',
            'meta' => 'required|numeric',
            'presupuesto' => 'required|numeric',
            'fechaI' => 'required|date',
            'fechaF' => 'required|date',
            'estado' => 'required',
            'objetivo_id' => 'required|numeric',

        ]);
        $actividad = new Actividad;
        $actividad->nombre = $request->input('nombreActividad');
        $actividad->estado = $request->input('estado');
        $actividad->indicador = $request->input('indicador');
        $actividad->tipo = $request->input('tipo');
        $actividad->metas = $request->input('meta');
        $actividad->presupuesto = $request->input('presupuesto');
        $actividad->fecha_inicio = $request->input('fechaI');
        $actividad->fecha_final = $request->input('fechaF');
        $actividad->objetivo_id=$request->input('objetivo_id');
        $actividad->save();

        return view('.plandeaccion.plan');

    }


     public function storeResponsable(Request $request)
    {
        $this->validate($request,[
            'nombreResponsable' => 'required',
            'apellidoResponsable' => 'required',
        
        ]);

        $responsable = new Responsable;
        $responsable->nombre = $request->input('nombreResponsable');
        $responsable->apellido = $request->input('apellidoResponsable');
        $responsable->save();

        return view('.plandeaccion.plan');

    }
    **/
    
}
