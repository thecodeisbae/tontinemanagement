<?php

namespace App\Http\Controllers;

use App\Models\Mise;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    //
    function home()
    {
        $title = "Accueil";
        return view('welcome',compact('title'));
    }

    function login()
    {
        return view('login');
    }

    function checkLogin()
    {
        request()->validate(
            [
                'login'=>'required|string|max:255',
                'password'=>'required'
            ]
        );
        $login = request('login');
        $pwd = request('password');
        $model = Utilisateur::where('login', $login)->first();
        //dd($model);
        if ($model != null) {
            if (Hash::check($pwd, $model->password, []))
            {
                session()->put('user_id',$model->id);
                return redirect('/')->with('info','Bon retour sur votre tableau de bord '.$login);
            }
        }

        return back()->with('warning','Vérifier vos paramètres de connexion');
    }

    function logout()
    {
        session()->forget('user_id');
        return redirect('/login')->with('info','Vous êtes à présent déconnecté');
    }

    function mises()
    {
        $title = "Mises";
        $mises = Mise::all();
        return view('mises',compact('mises','title'));
    }

    function deletemise($id)
    {
        Mise::destroy($id);
        return back()->with('success','Cette mise a été correctement supprimée');
    }

}
