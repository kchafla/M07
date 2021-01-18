<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Prueba extends Controller
{
    public function pagina() {
        return view("prueba");
    }
}
