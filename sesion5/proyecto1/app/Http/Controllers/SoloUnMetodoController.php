<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoloUnMetodoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $datos = array('dato1' => 'valor1', 'dato2' => 'valor2');
        return view('miVista', compact('datos'));
    }
}
