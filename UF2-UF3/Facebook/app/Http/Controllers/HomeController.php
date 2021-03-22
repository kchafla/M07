<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\NewPostNotification;
use App\Events\NewCommentNotification;
use App\Events\NewLikeNotification;
use App\Events\NewDislikeNotification;
use App\Events\NewMessageNotification;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFacebook() 
    {
        $data["posts"] = Post::orderBy("id", "DESC")->get();
        $data["comments"] = Comment::orderBy("id", "ASC")->get();
        $data["likes"] = Like::all();
        $data["user"] = Auth::user()->id;
        
        return view("facebook", $data);
    }

    public function indexChat() 
    {
        return view("chat");
    }

    public function usuarios() 
    {
        return User::all();
    }

    public function mensajes()
    {
        return Message::orderBy("id", "DESC")->get();
    }

    public function mensajear(Request $request)
    {
        $validated = $request->validate([
            "cuerpo" => "required",
            "to" => "required",
        ]);

        $mensaje = new Message;
        $mensaje->setAttribute("from", Auth::user()->id);
        $mensaje->setAttribute("to", $validated["to"]);
        $mensaje->setAttribute("message", $validated["cuerpo"]);
        $mensaje->save();

        event(new NewMessageNotification($mensaje));

        return back();
    }

    public function enviar(Request $request)
    {
        $validated = $request->validate([
            "cuerpo" => "required",
            "imagen" => "image|dimensions:max_width=1920,max_height=1080",
        ]);

        $post = new Post;
        $post->setAttribute("from", Auth::user()->name);
        $post->setAttribute("body", $validated["cuerpo"]);
        if (array_key_exists("imagen", $validated)) {
            $imagen = $request->file("imagen");
            $nombre = $imagen->getClientOriginalName();
            $imagen->move("img/", $nombre);

            $post->setAttribute("image", "img/".$nombre);
        }
        $post->save();

        event(new NewPostNotification($post));

        return back();
    }

    public function like(Request $request)
    {
        $found = Like::where("post_id", $request->id)->where("user_id", Auth::user()->id)->get();

        if (count($found) == 0) {
            $like = new Like;
            $like->setAttribute("post_id", $request->id);
            $like->setAttribute("user_id", Auth::user()->id);
            $like->save();

            event(new NewLikeNotification($like));
        } else {
            event(new NewDislikeNotification(Like::find($found[0]->id)));

            Like::where("post_id", $request->id)->where("user_id", Auth::user()->id)->delete();
        }

        return back();
    }

    public function borrar(Request $request) 
    {
        Post::destroy($request->id);
        return back();
    }

    public function comentar(Request $request)
    {
        $validated = $request->validate([
            "mensaje" => "required",
        ]);

        $comment = new Comment;
        $comment->setAttribute("post_id", $request->id);
        $comment->setAttribute("from", Auth::user()->name);
        $comment->setAttribute("body", $validated["mensaje"]);
        $comment->save();

        event(new NewCommentNotification($comment));

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
