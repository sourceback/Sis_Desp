<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User as Modeloprincipal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    //
    private $arrInfo = [
        'tabla' => 'users',
        'ruta' => 'usuarios',
        'llave' => 'usuario',
        'activo' => '66'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function create(){
        $this->arrInfo['arrRecord'] = [
            'name' => '',
            'username' => '',
            'estatus' => 1,
            'email' => '@gmail.com'
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
                'estatus' => $request->estatus,
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
                            $query->where($tabla.'.name', 'like','%'.$arrSearch['nombre'].'%');
                        }
                    );
        }

        $queryClause = $queryClause->orderBy($this->arrInfo['tabla'].'.created_at','asc');      

        $arrRecords = $queryClause->get();  
        $this->arrInfo['arrSearch'] = $arrSearch;    
        $this->arrInfo['arrRecords'] = $arrRecords;
        return view($this->arrInfo['llave'].'.index', ['arrInfo' => $this->arrInfo]); 
        //return view('/'.$this->arrInfo['llave'].'/index', compact('datos'));
    }

    public function store(Request $request)
    {
    
        $theRecord = new Modeloprincipal();
        $theRecord->username = $request->username;
        $theRecord->name = $request->name;
        $theRecord->email = $request->email;
        $theRecord->estatus = $request->estatus;
        $theRecord->password = $request->password;//password_hash($pass, PASSWORD_DEFAULT);
        $theRecord->save();
        return redirect('/'.$this->arrInfo['ruta'].'/'.$theRecord->id.'/edit')->with('success', "Account successfully registered.");

    }

    public function edit($id)
    {
        $this->arrInfo['arrRecord'] = Modeloprincipal::find($id);
        return view($this->arrInfo['llave'].'/edit', ['arrInfo' => $this->arrInfo]);
        
    }

    public function update(Request $request, $id)
    {
        $theRecord = Modeloprincipal::find($id);
        $theRecord->username = $request->username;
        $theRecord->name = $request->name;
        $theRecord->estatus = $request->estatus;
        $theRecord->email = $request->email;
        if ($request->password != '') {
            $pass = $request->password;
            $theRecord->password = $request->password;
        }
        $theRecord->save();
        return redirect('/'.$this->arrInfo['ruta'].'/'.$theRecord->id.'/edit')->with("success", "Actualizado con exito!!");
    }

    public function destroy($id)
    {
        $theRecord = Modeloprincipal::find($id);
        $theRecord->delete();
        //return redirect()->route($this->arrInfo['llave'].'.index')->with("success", "Eliminado con exito"); 
        return redirect('/'.$this->arrInfo['ruta'])->with("success", "Eliminado con exito");


    }

    public function perform()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('auth.login');
    }

    

}