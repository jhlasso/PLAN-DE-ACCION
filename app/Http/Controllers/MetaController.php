<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PlanDeAccion\app\Http\Requests;
use App\Meta;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MetaFormRequest;
use DB;

class MetaController extends Controller
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
            $metas=DB::table('meta')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);

            return view('plandeaccion.metas.index',["metas"=>$metas,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view('plandeaccion.metas.create');

    }

    public function store(MetaFormRequest $request)
    {
        $responsable = new Meta;
        $responsable->nombre = $request->get('nombreMeta');
        $responsable->meta = $request->get('meta');
        $responsable->fecha = $request->get('fechaM');
        $responsable->save();

        return Redirect::to('plandeaccion/metas');
    }

    public function edit($id)
    {
        return view("plandeaccion.metas.edit",["meta"=>Meta::findOrFail($id)]);
    }

    public function update(MetaFormRequest $request, $id)
    {
        $meta = Meta::findOrFail($id);
        $meta->nombre = $request->get('nombreMeta');
        $meta->meta = $request->get('meta');
        $meta->fecha = $request->get('fechaM');
        $meta->cumplido = $request->get('cumplido');
        $meta->update();

        return Redirect::to('plandeaccion/metas');

    }

    public function destroy($id)
    {
        try
        {
            Meta::destroy($id);
            return Redirect::to('plandeaccion/metas');

        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return Redirect::to('plandeaccion/metas')->with('msj', 'La meta no se puede eliminar por que tiene actividades asignadas');
        }
        

    }
}
