<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente as Modeloprincipal;
use App\Models\Cliente as Cliente;
use App\Models\Archivoexpediente as Archivoexpediente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ExpedienteController extends Controller
{
    //
    private $arrInfo = [
        'tabla' => 'expedientes',
        'ruta' => 'expedientes',
        'llave' => 'expediente',
        'activo' => '8'
    ];

    private $arrRules = [
        'cliente_id' => 'required|integer|exists:clientes,id',
        'materia_id' => 'required|integer|exists:materias,id',
        'instancia_id' => 'required|integer|exists:instancias,id',
        'tipoexpediente_id' => 'required|integer|exists:tipoexpedientes,id',
        'abogado_id' => 'integer|exists:abogados,id',
        'etapa_id' => 'required|integer|exists:etapas,id',
        'contraparte_id' => 'integer|exists:clientes,id',
        'clave' => 'required|string|max:45|unique:expedientes',
        'noexpediente' => 'required|string|max:10',
        'nombre' => 'required|string|max:100',
        'comentarios' => 'nullable|string',
        'estatus' => 'required|boolean',
        'sentenciaeje' => 'nullable|string',
        'fechaini' => 'required|date_format:Y-m-d',
        'fechafin' => 'required|date_format:Y-m-d',
        'fechaejeini' => 'date_format:Y-m-d',
        'fechaejeini' => 'date_format:Y-m-d',
    ];

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function create(){
        $this->arrInfo['arrRecord'] = [
            'clave' => (string) Str::uuid(),
            'cliente_id' => 0,
            'contraparte_id' => 0,
            'materia_id' => 0,
            'instancia_id' => 0,
            'tipoexpediente_id' => 0,
            'abogado_id' => 0,
            'etapa_id' => 0,
            'nombre' => '',
            'sentencia' => 0,
            'sentenciaeje' => '',
            'estadoexpedi' => 1,
            'fechaini' => date('Y-m-d'),
            'fechafin' => date('Y-m-d'),
            'fechaejeini' => date('Y-m-d'),
            'fechaejefin' => date('Y-m-d'),
            'noexpediente' => '',
            'comentarios' => '',
            'estatus' => '',
            
        ];
        return view($this->arrInfo['llave'].'.create', ['arrInfo' => $this->arrInfo]);
    }


    public function obtenerDatos($datos)
    {
        
        $queryClause = Modeloprincipal::query();
        //dd($arrSearch);
        if ($datos['fechaT'] == 2) {
            $queryClause = $queryClause->whereBetween($this->arrInfo['tabla'].'.created_at', [$datos['fechaD'].' 00:00:00', $datos['fechaH'].' 23:59:59']);
        }

        if (count($datos['cliente_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.cliente_id', $datos['cliente_id']);
        }

        if (count($datos['materia_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.materia_id', $datos['materia_id']);
        }

        if (count($datos['instancia_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.instancia_id', $datos['instancia_id']);
        }

        if (count($datos['tipoexpediente_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.tipoexpediente_id', $datos['tipoexpediente_id']);
        }

        if (count($datos['abogado_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.abogado_id', $datos['abogado_id']);
        }

        if (count($datos['etapa_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.etapa_id', $datos['etapa_id']);
        }

        if ($datos['estatus'] != 2) {
            $queryClause = $queryClause->where($this->arrInfo['tabla'].'.estatus', $datos['estatus']);
        }

        if ($datos['nombre']!=null) {
            $tabla = $this->arrInfo['tabla'];

            $queryClause = $queryClause->where(function($query) use ($datos, $tabla){
                            $query->where($tabla.'.nombre', 'like','%'.$datos['nombre'].'%');
                            $query->orWhere($tabla.'.clave', 'like','%'.$datos['nombre'].'%');
                            $query->orWhere($tabla.'.noexpediente', 'like','%'.$datos['nombre'].'%');

                        }
                    );
        }

        $queryClause = $queryClause->orderBy($this->arrInfo['tabla'].'.created_at','asc');      

        $arrRecords = $queryClause->get();

        return $arrRecords;
        
    }    

    public function index(Request $request)
    {   

        if($request->valor == 1){
            $arrSearch = [
                'nombre' => $request->nombre,
                'cliente_id' => $request->has('cliente_id')?$request->cliente_id:[],
                'contraparte_id' => $request->has('contraparte_id')?$request->contraparte_id:[],
                'materia_id' => $request->has('materia_id')?$request->materia_id:[],
                'tipoexpediente_id' => $request->has('tipoexpediente_id')?$request->tipoexpediente_id:[],
                'abogado_id' => $request->has('abogado_id')?$request->abogado_id:[],
                'etapa_id' => $request->has('etapa_id')?$request->etapa_id:[],
                'instancia_id' => $request->has('instancia_id')?$request->instancia_id:[],
                'fechaD' => $request->fechaD,
                'fechaH' => $request->fechaH,
                'fechaT' => $request->fechaT,
                'estatus' => $request->estatus
            ];
        }else{
            $arrSearch = [
                'nombre' => '',
                'cliente_id' => [],
                'contraparte_id' => [],
                'materia_id' => [],
                'tipoexpediente_id' => [],
                'abogado_id' => [],
                'etapa_id' => [],
                'instancia_id' => [],
                'fechaD' => date('Y-m-d'),
                'fechaH' => date('Y-m-d'),
                'fechaT' => 1,
                'estatus' => 2
            ];
        }
        $arrRecords = $this->obtenerDatos($arrSearch);  
        $this->arrInfo['arrSearch'] = $arrSearch;    
        $this->arrInfo['arrRecords'] = $arrRecords;
        return view($this->arrInfo['llave'].'.index', ['arrInfo' => $this->arrInfo]); 
    }

    public function store(Request $request)
    {


        $validator = \Validator::make($request->all(), $this->arrRules);
        
        if ($validator->fails()) {
                return redirect('/'.$this->arrInfo['ruta'].'/create')
                        ->withErrors($validator)
                        ->withInput();

        } else {

            $theRecord = new Modeloprincipal();
                $theRecord->clave = $request->clave;
                $theRecord->nombre = $request->nombre;
                $theRecord->fechaini = $request->fechaini;
                $theRecord->fechafin = $request->fechafin;
                $theRecord->estadoexpedi = $request->estadoexpedi;
                $theRecord->sentencia = 0;
                $theRecord->sentenciaeje = $request->filled('sentenciaeje')?$request->sentenciaeje:'';
                $theRecord->noexpediente = $request->noexpediente;
                $theRecord->cliente_id = $request->cliente_id;
                $theRecord->fechaejeini = date('Y-m-d');
                $theRecord->fechaejefin = date('Y-m-d');
                $theRecord->contraparte_id = $request->contraparte_id;
                $theRecord->materia_id = $request->materia_id;
                $theRecord->instancia_id = $request->instancia_id;
                $theRecord->tipoexpediente_id = $request->tipoexpediente_id;
                $theRecord->abogado_id = $request->abogado_id;
                $theRecord->etapa_id = $request->etapa_id;
                $theRecord->estatus = $request->estatus;
                $theRecord->comentarios = $request->filled('comentarios')?$request->comentarios:'';
            $theRecord->save();
            return redirect('/'.$this->arrInfo['ruta'].'/'.$theRecord->id.'/edit')->with("success", "Actualizado con exito!!");

        }
    }

    public function edit($id)
    {
        $this->arrInfo['arrRecord'] = Modeloprincipal::find($id);
        return view($this->arrInfo['llave'].'/edit', ['arrInfo' => $this->arrInfo]);
        
    }

    public function update(Request $request, $id)
    {
        $this->arrRules['clave'] = 'required|string|max:45|unique:'.$this->arrInfo['tabla'].',clave,'.$id;

        $validator = \Validator::make($request->all(), $this->arrRules);
        if ($validator->fails()) {
                return redirect('/'.$this->arrInfo['ruta'].'/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        $theRecord = Modeloprincipal::find($id);
            $theRecord->clave = $request->clave;
            $theRecord->nombre = $request->nombre;
            $theRecord->fechaini = $request->fechaini;
            $theRecord->fechafin = $request->fechafin;
            $theRecord->estadoexpedi = $request->estadoexpedi;
            $theRecord->sentencia = $request->has('sentencia');
            $theRecord->sentenciaeje = $request->filled('sentenciaeje')?$request->sentenciaeje:'';
            $theRecord->noexpediente = $request->noexpediente;
            $theRecord->cliente_id = $request->cliente_id;
            $theRecord->fechaejeini = $request->fechaejeini;
            $theRecord->fechaejefin = $request->fechaejefin;
            $theRecord->contraparte_id = $request->contraparte_id;
            $theRecord->materia_id = $request->materia_id;
            $theRecord->instancia_id = $request->instancia_id;
            $theRecord->tipoexpediente_id = $request->tipoexpediente_id;
            $theRecord->abogado_id = $request->abogado_id;
            $theRecord->etapa_id = $request->etapa_id;
            $theRecord->estatus = $request->estatus;
            $theRecord->comentarios = $request->filled('comentarios')?$request->comentarios:'';
        $theRecord->save();
        return redirect('/'.$this->arrInfo['ruta'].'/'.$theRecord->id.'/edit')->with("success", "Actualizado con exito!!");
        }
    }
    

    public function destroy($id)
    {
        $theRecord = Modeloprincipal::find($id);
        $theRecord->delete();
        //return redirect()->route($this->arrInfo['llave'].'.index')->with("success", "Eliminado con exito"); 
        return redirect('/'.$this->arrInfo['ruta'])->with("success", "Eliminado con exito");


    }

    public function ajaxlist(Request $request){

      $search = $request->search;
        $queryClause = Modeloprincipal::orderby('nombre','asc')
            ->where('estatus', 1)->select('id','nombre')
            ->where('nombre', 'like', '%' .$search . '%')
            ->limit(5)->get();

      $response = array();
      foreach($queryClause as $queryClaus){
         $response[] = array(
              "id"=>$queryClaus->id,
              "text"=>$queryClaus->nombre
         );
      }

      return response()->json($response);
   }


   

    public function archivoexpediente($id){

        $this->arrInfo['arrRecord'] = Modeloprincipal::find($id);
        return view($this->arrInfo['llave'].'/archivoexpediente', ['arrInfo' => $this->arrInfo]);
    }

    public function archivoexpedientedo(Request $request, $id){
        
        $file = $request->file('file');
        $path = public_path() . '/images/projects';
        $fileName = $file->getClientOriginalName().uniqid() ;
        $nombre = $file->getClientOriginalName();
        $file->move($path, $fileName);

        $projectImage = new Archivoexpediente();
        $projectImage->expediente_id = $id;
        $projectImage->nombre = $nombre;
        $projectImage->archivo = '/images/projects/'.$fileName;
        $projectImage->save();
    }

    public function download($id){

        $file = Archivoexpediente::where('id', $id)->firstOrFail();
        $pathToFile = public_path($file->archivo);
        return response()->download($pathToFile);

    }
    public function eliminarimagen(Request $request,$id)
    {
        $theRecord = Archivoexpediente::find($id);
        $idantigua = $theRecord->expediente_id;
        $theRecord->delete();
        return redirect('/'.$this->arrInfo['ruta'].'/'.$idantigua.'/edit')->with("success", "Actualizado con exito!!");
    }




    

}