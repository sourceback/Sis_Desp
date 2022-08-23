<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crude as Modeloprincipal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CrudeController extends Controller
{
    //
    private $arrInfo = [
        'tabla' => 'crudes',
        'ruta' => 'crudes',
        'llave' => 'crude',
        'activo' => '77'
    ];

    private $arrRules = [
        'clave' => 'required|string|max:45|unique:crudes',
        'nombre' => 'required|string|max:100',
        'comentarios' => 'nullable|string',
        'estatus' => 'required|boolean',
    ];

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function create(){
        $this->arrInfo['arrRecord'] = [
            'clave' => (string) Str::uuid(),
            'nombre' => '',
            'comentarios' => '',
            'estatus' => '',
            
        ];
        return view($this->arrInfo['llave'].'.create', ['arrInfo' => $this->arrInfo]);
    }

    public function index(Request $request)
    {   

        if($request->valor == 1){
            $arrSearch = [
                'nombre' => $request->nombre,
                'fechaD' => $request->fechaD,
                'fechaH' => $request->fechaH,
                'fechaT' => $request->fechaT,
                'estatus' => $request->estatus
            ];
        }else{
            $arrSearch = [
                'nombre' => '',
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
        //return view('/'.$this->arrInfo['llave'].'/index', compact('datos'));
    }

    public function obtenerDatos($datos)
    {
        
        $queryClause = Modeloprincipal::query();
        //dd($arrSearch);
        if ($datos['fechaT'] == 2) {
            $queryClause = $queryClause->whereBetween($this->arrInfo['tabla'].'.created_at', [$datos['fechaD'].' 00:00:00', $datos['fechaH'].' 23:59:59']);
        }

        if ($datos['estatus'] != 2) {
            $queryClause = $queryClause->where($this->arrInfo['tabla'].'.estatus', $datos['estatus']);
        }

        if ($datos['nombre']!=null) {
            $tabla = $this->arrInfo['tabla'];

            $queryClause = $queryClause->where(function($query) use ($datos, $tabla){
                            $query->where($tabla.'.nombre', 'like','%'.$datos['nombre'].'%');
                            $query->orWhere($tabla.'.clave', 'like','%'.$datos['nombre'].'%');
                        }
                    );
        }

        $queryClause = $queryClause->orderBy($this->arrInfo['tabla'].'.created_at','asc');      

        $arrRecords = $queryClause->get();

        return $arrRecords;
        
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
        $theRecord->estatus = $request->estatus;
        $theRecord->comentarios = $request->filled('comentarios')?$request->comentarios:'';
        $theRecord->save();
        return redirect('/'.$this->arrInfo['ruta'].'/'.$theRecord->id.'/edit')->with('success', "Account successfully registered.");

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

    public function ajaxlist2(Request $request)
    {
        $queryClause = Modeloprincipal::select('id','nombre as text')->orderBy('id','DESC');
        $arrRecords['results'] = $queryClause->get();
        
        return response()->json($arrRecords);
    
    }

    public function ajaxlist(Request $request){

      $search = $request->search;

      
        $queryClause = Modeloprincipal::orderby('nombre','asc')
            ->where('estatus', 1)->select('id','nombre')
            ->where('nombre', 'like', '%' .$search . '%')
            ->limit(3)
            ->get();
    

      $response = array();
      foreach($queryClause as $queryClaus){
         $response[] = array(
              "id"=>$queryClaus->id,
              "text"=>$queryClaus->nombre
         );
      }

      return response()->json($response);
   }




    

}