<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercici2Controller extends Controller
{
    public function Exercici2(Request $request) {
        return view("exercici2");
    }

    public function Validacio2(Request $request) {
        $validated = $request->validate([
            'correo' => 'required|email',
            'nif' => 'required',
            'fichero' => 'required|file|max:1024',
            'imagen' => 'required|image|dimensions:max_width=1920,max_height=1080',
        ]);

        $image = $request->file('imagen');
        $destinationPath = 'img/';
        $originalImage = $image->getClientOriginalName();
        $image->move($destinationPath, $originalImage);

        $file = $request->file('fichero');
        $destinationPath = 'files/';
        $originalFile = $file->getClientOriginalName();
        $file->move($destinationPath, $originalFile);

        $data['validated'] = $validated;
        $data['originalImage'] = $originalImage;
        $data['originalFile'] = $originalFile;
        return view("validacio2", ['data' => $data]);
    }
}