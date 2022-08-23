<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario as Modeloprincipal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    //
    private $arrInfo = [
        'tabla' => 'calendarios',
        'ruta' => 'calendarios',
        'llave' => 'calendario',
        'activo' => '18'
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
        return view($this->arrInfo['llave'].'.index', ['arrInfo' => $this->arrInfo]); 
        //return view('/'.$this->arrInfo['llave'].'/index', compact('datos'));
    }

    public function store(Request $request)
    {
        
        $theRecord = new Modeloprincipal();
            $theRecord->clave = (string) Str::uuid();
            $theRecord->title = $request->title;
            $theRecord->comentarios = $request->filled('comentarios')?$request->comentarios:'';
            $theRecord->start = $request->start;
            $theRecord->end = date('Y-m-d');
        $theRecord->save();
        //$calendario= Modeloprincipal::create($request->all());

    }

    public function edit($id)
    {
        $theRecord = Modeloprincipal::find($id);

        $fecha = $theRecord->start;
        dd($theRecord->start);
        $dt = new DateTime($fecha);

        $theRecord->start = $dt;
        return response()->json($theRecord);
        
    }

    public function update(Request $request, $id)
    {
        $theRecord = Modeloprincipal::find($id);
        $theRecord->clave = $request->clave;
        $theRecord->nombre = $request->nombre;
        $theRecord->estatus = $request->estatus;
        $theRecord->comentarios = $request->comentarios;
        $theRecord->save();
        return redirect('/'.$this->arrInfo['ruta'].'/'.$theRecord->id.'/edit')->with("success", "Actualizado con exito!!");
    }

    public function show()
    {
        $theRecord = Modeloprincipal::all();
        return response()->json($theRecord);



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