<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    private $arrInfo = [
        'activo' => '56'

    ];

    public function __construct()
    {
        $this->middleware('auth');
    
    }
    public function index() 
    {
        return view('home.index',['arrInfo' => $this->arrInfo]);
    }
}