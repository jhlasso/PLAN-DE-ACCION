<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PlanDeAccion\app\Http\Requests;
use App\Responsable;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ResponsableFormRequest;
use DB;

class ResponsableController extends Controller
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
            $responsables=DB::table('responsable')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);

            return view('plandeaccion.responsables.index',["responsables"=>$responsables,"searchText"=>$query]);
        }
        

    }

    public function create()
    {
        return view('plandeaccion.responsables.create');

    }

    public function store(ResponsableFormRequest $request)
    {
        $responsable = new Responsable;
        $responsable->nombre = $request->get('nombreResponsable');
        $responsable->save();

        return Redirect::to('plandeaccion/responsables');
    }

    public function show($id)
    {
        return view("plandeaccion.responsables.show",["responsable"=>Responsable::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("plandeaccion.responsables.edit",["responsable"=>Responsable::findOrFail($id)]);
    }

    public function update(ResponsableFormRequest $request, $id)
    {
        $responsable = Responsable::findOrFail($id);
        $responsable->nombre = $request->get('nombreResponsable');
        $responsable->update();

        return Redirect::to('plandeaccion/responsables');

    }

    public function destroy($id)
    {
        try
        {
            Responsable::destroy($id);
            return Redirect::to('plandeaccion/responsables');

        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return Redirect::to('plandeaccion/responsables')->with('msj', 'El responsable no se puede eliminar por que tiene actividades asignadas');
        }
        

    }
}
