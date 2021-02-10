<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosController extends Controller
{
    public function index() {
        $data["libros"] = Libro::all();

        return view("libros.index", $data);
    }

    public function create() {
        return view("libros.create");
    }

    public function save(Request $request) {
        $libro = Libro::create([
            "nom" => $request->nom,
            "edicio" => $request->edicio,
            "editorial" => $request->editorial
        ]);

        return redirect("libros");
    }

    public function delete($id) {
        Libro::destroy($id);

        return redirect("libros");
    }

    public function edit($id) {
        $libro = Libro::find($id);
        $data["libro"] = $libro;

        return view("libros.edit", $data);
    }

    public function update(Request $request) {
        Libro::where('id', $request->id)->update([
            "nom" => $request->nom,
            "edicio" => $request->edicio,
            "editorial" => $request->editorial
        ]);

        return redirect("libros");
    }
}
