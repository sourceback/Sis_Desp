<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente as Modeloprincipal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ContraparteController extends Controller
{
    //
    private $arrInfo = [
        'tabla' => 'clientes',
        'ruta' => 'contrapartes',
        'llave' => 'contraparte',
        'activo' => '22'
    ];

    private $arrRules = [
        'clave' => 'required|string|max:45|unique:clientes',
        'nombre' => 'required|string|max:100',
        'direccion' => 'required|string|max:100',
        'ciudad' => 'required|string|max:45',
        'codigo_postal' => 'required|string|max:45',
        'correo' => 'required|email|max:45',
        'telefono' => 'required|string|max:45',
        'rfc' => 'required|string|max:45',
        'profesion' => 'required|string|max:45',
        'tipo' => 'required|boolean',
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
            'estatus' => 1,
            'direccion' => '',
            'ciudad' => '',
            'telefono' => '',
            'codigo_postal' => '',
            'correo' => '',
            'profesion' => '',
            'rfc' => '',
            'tipo' => 1,
            'tipo_cliente' => 1,
            
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
                'cliente' => 0,
                'estatus' => $request->estatus
            ];
        }else{
            $arrSearch = [
                'nombre' => '',
                'fechaD' => date('Y-m-d'),
                'fechaH' => date('Y-m-d'),
                'cliente' => 0,
                'fechaT' => 1,
                'estatus' => 2
            ];
        }

                        
        $queryClause = Modeloprincipal::query();
        //dd($arrSearch);
        if ($arrSearch['fechaT'] == 2) {
            $queryClause = $queryClause->whereBetween($this->arrInfo['tabla'].'.created_at', [$arrSearch['fechaD'].' 00:00:00', $arrSearch['fechaH'].' 23:59:59']);
        }

        if ($arrSearch['estatus'] != 2) {
            $queryClause = $queryClause->where($this->arrInfo['tabla'].'.estatus', $arrSearch['estatus']);
        }



        if ($arrSearch['nombre']!=null) {
            $tabla = $this->arrInfo['tabla'];

            $queryClause = $queryClause->where(function($query) use ($arrSearch, $tabla){
                            $query->where($tabla.'.nombre', 'like','%'.$arrSearch['nombre'].'%');
                            
                        }

                    );
        }
        $queryClause = $queryClause->where($this->arrInfo['tabla'].'.tipo_cliente',1);      


        $queryClause = $queryClause->orderBy($this->arrInfo['tabla'].'.created_at','asc');      

        $arrRecords = $queryClause->get();  
        $this->arrInfo['arrSearch'] = $arrSearch;    
        $this->arrInfo['arrRecords'] = $arrRecords;
        return view($this->arrInfo['llave'].'.index', ['arrInfo' => $this->arrInfo]); 
        //return view('/'.$this->arrInfo['llave'].'/index', compact('datos'));
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
            $theRecord->direccion = $request->direccion;
            $theRecord->ciudad = $request->ciudad;
            $theRecord->codigo_postal = $request->codigo_postal;
            $theRecord->correo = $request->correo;
            $theRecord->profesion = $request->profesion;
            $theRecord->tipo = $request->tipo;
            $theRecord->tipo_cliente = 1;
            $theRecord->telefono = $request->telefono;
            $theRecord->rfc = $request->rfc;
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
            $theRecord->direccion = $request->direccion;
            $theRecord->ciudad = $request->ciudad;
            $theRecord->codigo_postal = $request->codigo_postal;
            $theRecord->correo = $request->correo;
            $theRecord->telefono = $request->telefono;
            $theRecord->profesion = $request->profesion;
            $theRecord->tipo = $request->tipo;
            $theRecord->tipo_cliente = 1;
            $theRecord->rfc = $request->rfc;
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

    public function ajaxlist2(Request $request){

      $search = $request->search;

      
        $queryClause = Modeloprincipal::orderby('nombre','asc')
            ->where('estatus', 1)->select('id','nombre')
            ->where('tipo_cliente', 0)->select('id','nombre')
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

    public function ajaxlist(Request $request){

      $search = $request->search;

      
        $queryClause = Modeloprincipal::orderby('nombre','asc')
            ->where('estatus', 1)->select('id','nombre')
            ->where('tipo_cliente', 1)->select('id','nombre')
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