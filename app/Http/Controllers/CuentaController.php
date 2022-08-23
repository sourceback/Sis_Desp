<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta as Modeloprincipal;
use App\Models\Gasto as Gasto;

//use App\Models\Archivo as Archivo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CuentaController extends Controller
{
    //
    private $arrInfo = [
        'tabla' => 'cuentas',
        'ruta' => 'cuentas',
        'llave' => 'cuenta',
        'activo' => '99'
    ];

    private $arrRules = [
        'expediente_id' => 'required|integer|exists:expedientes,id',
        'clave' => 'required|string|max:45|unique:cuentas',
        'fecha' => 'required|date_format:Y-m-d',
        'monto' => 'required|numeric|between:0,9999999999999.99',
        'comentarios' => 'nullable|string',
        'estatus' => 'required|boolean',
        'estado' => 'required|boolean',
    ];

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function create(){
        $this->arrInfo['arrRecord'] = [
            'clave' => (string) Str::uuid(),
            'expediente_id' => 0,
            'estado' => 0,
            'fecha' => date('Y-m-d'),
            'monto' => 0,
            'nombre' => '',
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

        if (count($datos['expediente_id']) > 0) {
            $queryClause = $queryClause->whereIn($this->arrInfo['tabla'].'.expediente_id', $datos['expediente_id']);
        }

        if ($datos['estatus'] != 2) {
            $queryClause = $queryClause->where($this->arrInfo['tabla'].'.estatus', $datos['estatus']);
        }

        if ($datos['estado'] != 2) {
            $queryClause = $queryClause->where($this->arrInfo['tabla'].'.estado', $datos['estado']);
        }

        if ($datos['nombre']!=null) {
            $tabla = $this->arrInfo['tabla'];

            $queryClause = $queryClause->where(function($query) use ($datos, $tabla){
                            $query->where($tabla.'.nombre', 'like','%'.$datos['nombre'].'%');
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
                'expediente_id' => $request->has('expediente_id')?$request->expediente_id:[],
                'fechaD' => $request->fechaD,
                'fechaH' => $request->fechaH,
                'fechaT' => $request->fechaT,
                'estatus' => $request->estatus,
                'estado' => $request->estado
            ];
        }else{
            $arrSearch = [
                'nombre' => '',
                'expediente_id' => [],
                'fechaD' => date('Y-m-d'),
                'fechaH' => date('Y-m-d'),
                'fechaT' => 1,
                'estatus' => 2,
                'estado' => 2
            ];
        }
        $arrRecords = $this->obtenerDatos($arrSearch);  
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
            $theRecord->monto = $request->monto;
            $theRecord->fecha = $request->fecha;
            $theRecord->estado = $request->estado;
            $theRecord->expediente_id = $request->expediente_id;
            //dd($request->estatus);
            $theRecord->estatus = $request->estatus;
            $theRecord->comentarios = $request->filled('comentarios')?$request->comentarios:'';
            if($theRecord->save()){
                if($request->estado == 1){
                    $theRecordGasto = new Gasto();
                    $theRecordGasto->nombre = $request->nombre;
                    $theRecordGasto->clave = $request->clave;
                    $theRecordGasto->estatus = $request->estatus;
                    $theRecordGasto->tipo = 0;
                    $theRecordGasto->monto = $request->monto;
                    $theRecordGasto->comentarios = $request->filled('comentarios')?$request->comentarios:'';
                    $theRecordGasto->save();
                }
            }
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
                return redirect('/'.$this->arrInfo['ruta'].'/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        $theRecord = Modeloprincipal::find($id);
        $theRecord->clave = $request->clave;
        $theRecord->nombre = $request->nombre;
        $theRecord->monto = $request->monto;
        $theRecord->fecha = $request->fecha;
        $theRecord->estado = $request->estado;
        if($request->estado == 1){
            $theRecordGasto = new Gasto();
            $theRecordGasto->nombre = $request->nombre;
            $theRecordGasto->clave = $request->clave;
            $theRecordGasto->estatus = $request->estatus;
            $theRecordGasto->tipo = 0;
            $theRecordGasto->monto = $request->monto;
            $theRecordGasto->comentarios = $request->filled('comentarios')?$request->comentarios:'';;
        }
        $theRecord->expediente_id = $request->expediente_id;
        $theRecord->estatus = $request->estatus;
        $theRecord->comentarios = $request->filled('comentarios')?$request->comentarios:'';
        if($theRecord->save()){
            if($request->estado == 1){
                $theRecordGasto = new Gasto();
                $theRecordGasto->nombre = $request->nombre;
                $theRecordGasto->clave = $request->clave;
                $theRecordGasto->estatus = $request->estatus;
                $theRecordGasto->tipo = 0;
                $theRecordGasto->monto = $request->monto;
                $theRecordGasto->comentarios = $request->filled('comentarios')?$request->comentarios:'';
                $theRecordGasto->save();
            }
        }
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


   //SUBIR LOS ARCHIVOS

    //public function archivo($id){
//
    //    $this->arrInfo['arrRecord'] = Modeloprincipal::find($id);
    //    return view($this->arrInfo['llave'].'/archivo', ['arrInfo' => $this->arrInfo]);
    //}
//
    //public function archivodo(Request $request, $id){
    //    
    //    $file = $request->file('file');
    //    $path = public_path() . '/images/projects';
    //    $fileName = $file->getClientOriginalName().uniqid() ;
    //    $nombre = $file->getClientOriginalName();
    //    $file->move($path, $fileName);
//
    //    $projectImage = new Archivo();
    //    $projectImage->crudi_id = $id;
    //    $projectImage->nombre = $nombre;
    //    $projectImage->archivo = '/images/projects/'.$fileName;
    //    $projectImage->save();
    //}
//
    //public function download($id){
//
    //    $file = Archivo::where('id', $id)->firstOrFail();
    //    $pathToFile = public_path($file->archivo);
    //    return response()->download($pathToFile);
//
    //}
    //public function eliminarimagen(Request $request,$id)
    //{
    //    $theRecord = Archivo::find($id);
    //    $idantigua = $theRecord->crudi_id;
    //    $theRecord->delete();
    //    return redirect('/'.$this->arrInfo['ruta'].'/'.$idantigua.'/edit')->with("success", "Actualizado con exito!!");
    //}




    

}