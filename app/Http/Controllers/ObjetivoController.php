<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PlanDeAccion\app\Http\Requests;
use App\Objetivo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ObjetivoFormRequest;
use DB;

class ObjetivoController extends Controller
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
            $objetivos=DB::table('objetivo as o')
            ->join('plan as p', 'p.id','=','o.plan_id')
            ->select('o.id','o.nombre','p.nombre as plan')
            ->where('p.nombre','LIKE','%'.$query.'%')
            ->orderBy('o.id','desc')
            ->paginate(7);

            $planes=DB::table('plan as p')
            ->select('p.id','p.nombre')
            ->get();

            return view('plandeaccion.objetivos.index',["objetivos"=>$objetivos,"searchText"=>$query,"planes"=>$planes]);
        }
        

    }

    public function create()
    {
        $planes=DB::table('plan')->get();
        return view('plandeaccion.objetivos.create',["planes"=>$planes]);

    }

    public function store(ObjetivoFormRequest $request)
    {
        $objetivo = new Objetivo;
        $objetivo->plan_id=$request->get('plan_id');
        $objetivo->nombre = $request->get('nombreObjetivo');
        $objetivo->save();

        return Redirect::to('plandeaccion/objetivos');
    }

    public function show($id)
    {
        return view("plandeaccion.objetivos.show",["objetivo"=>Objetivo::findOrFail($id)]);
    }

    public function edit($id)
    {
        $objetivo = Objetivo::findOrFail($id);
        $planes = DB::table('plan')->get();
        return view("plandeaccion.objetivos.edit",["objetivo"=>$objetivo,"planes"=>$planes]);
    }

    public function update(ObjetivoFormRequest $request, $id)
    {
        $Objetivo = Objetivo::findOrFail($id);
        $Objetivo->nombre=$request->get('nombreObjetivo');
        $Objetivo->plan_id=$request->get('plan_id');
        $Objetivo->update();

        return Redirect::to('plandeaccion/objetivos');

    }

    public function destroy($id)
    {
       try
       {
            Objetivo::destroy($id);
            return Redirect::to('plandeaccion/objetivos');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return Redirect::to('plandeaccion/objetivos')->with('msj', 'El objetivo no se puede eliminar por que tiene actividades asignados');
        }

    }


}
