<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Events\NewPostNotification;

class HomeController extends Controller
{
    public function index() {
        return view("facebook");
    }

    public function enviar($id, $body) {
        $post = new Post;
        $post->setAttribute("from", $id);
        $post->setAttribute("body", $body);
        $post->save();

        event(new NewPostNotification($post));
    }
}
