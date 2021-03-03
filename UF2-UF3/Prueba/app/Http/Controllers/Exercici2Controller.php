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

        $image = $request->file("imagen");
        $originalImage = $image->getClientOriginalName();
        $image->move("img/", $originalImage);

        $file = $request->file("fichero");
        $originalFile = $file->getClientOriginalName();
        $file->move("files/", $originalFile);

        $data['validat'] = $validated;
        $data['imatge'] = $originalImage;
        $data['archiu'] = $originalFile;
        return view("validacio2", $data);
    }
}