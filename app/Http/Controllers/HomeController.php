<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = new User();
        $users = User::all();

        // Todos los amigos del usuario conectado
        $friends = Auth::check() ? Auth::user()->getFriends() : null;
        return view('home')->with([
            'onlines'=>$friends,
            'todos'=>$users

        ]);
    }

    public function beFriend($id)
    {
        // Usuario al que se le envía la solicitud
        $recipient = User::find($id);

        // Enviar solicitud de amistad
        Auth::user()->befriend($recipient);

        // Aceptar solicitud de amistad
        $recipient->acceptFriendRequest(Auth::user());

        return redirect('/');
    }

    public function privado($id)
    {
        $recipient = User::find($id);
        return view('chat.chatprivado')->with('recipient',$recipient);
    }

    public function agregar($id){
        $user=Auth::user();
        DB::table('friendships')->insert([
            'sender_type'=>'App\User',
            'sender_id'=>$user->id,
            'recipient_type'=>'App\User',
            'recipient_id'=>$id,
            'status'=>1
        ]);

        return back();

    }

}
