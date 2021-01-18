<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercici1Controller extends Controller
{
    public function Exercici1(Request $request) {
        return view("exercici1");
    }

    public function Validacio(Request $request) {
        $validated = $request->validate([
            'correo' => 'required',
            'edad' => 'required',
        ]);
        return view("validacio", $validated);
    }
}
