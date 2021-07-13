<?php

namespace App\Http\Controllers;

use App\Models\Client;
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

    function clients()
    {
        $title = "Clients";
        $clients = Client::all();
        return view('clients',compact('clients','title'));
    }

    function deleteClient($id)
    {
        Client::destroy($id);
        return back()->with('success','Ce client a été correctement supprimé');
    }

    function storeClient()
    {
        $client = new Client();
        $client->nom = request('nom');
        $client->prenoms = request('prenoms');
        $client->sexe = request('sexe');
        $client->contact = request('contact');
        $client->age = request('age');
        $client->save();
        return redirect('/clients')->with('success','Client enregistré avec succès');
    }

    function editClient($id)
    {
        $title = "Clients";
        $client = Client::find($id);
        return view('editClient',compact('client','title'));
    }

    function updateClient($id)
    {
        $data = [
            'nom' => request('nom'),
            'prenoms' => request('prenoms'),
            'sexe' => request('sexe'),
            'age' => request('age'),
            'contact' => request('contact')
        ];
        $client = Client::find($id);
        $client->update($data);
        return redirect('clients')->with('success','Mise à jour effectuée');
    }

    function mises()
    {
        $title = "Mises";
        $mises = Mise::all();
        return view('mises',compact('mises','title'));
    }

    function deleteMise($id)
    {
        Mise::destroy($id);
        return back()->with('success','Cette mise a été correctement supprimée');
    }

    function storeMise()
    {
        $mise = new Mise();
        $mise->montant = request('montant');
        $mise->duree = request('duree');
        $mise->save();
        return redirect('/mises')->with('success','Mise enregistrée avec succès');
    }

    function editMise($id)
    {
        $title = "Mises";
        $mise = Mise::find($id);
        return view('editMise',compact('mise','title'));
    }

    function updateMise($id)
    {
        $data = [
            'montant' => request('montant'),
            'duree' => request('duree')
        ];
        $mise = Mise::find($id);
        $mise->update($data);
        return redirect('mises')->with('success','Mise à jour effectuée');
    }

    function users()
    {
        $title = "Utilisateurs";
        $users = Utilisateur::all();
        return view('users',compact('users','title'));
    }

    function deleteUser($id)
    {
        Utilisateur::destroy($id);
        return back()->with('success','Cet utilisateur a été correctement supprimé');
    }

    function storeUser()
    {
        $user = new Utilisateur();
        $user->login = request('login');
        $user->password = Hash::make(request('password'));
        $user->role = request('role');
        $user->save();
        return redirect('/users')->with('success','Utilisateur enregistré avec succès');
    }

    function editUser($id)
    {
        $title = "Utilisateurs";
        $user = Utilisateur::find($id);
        return view('editUser',compact('user','title'));
    }

    function updateUser($id)
    {
        $data = [
            'login' => request('login'),
            'password' => Hash::make(request('password')),
            'role' => request('role')
        ];
        $user = Utilisateur::find($id);
        $user->update($data);
        return redirect('users')->with('success','Mise à jour effectuée');
    }

}
