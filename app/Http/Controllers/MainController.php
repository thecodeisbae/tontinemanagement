<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Mise;
use App\Models\Payement;
use App\Models\Souscription;
use App\Models\Utilisateur;
use Carbon\Carbon;
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

    function suscribes()
    {
        $mises = Mise::all();
        $clients = Client::all();
        $suscribes = Souscription::join('clients','souscriptions.client_id','=','clients.id')
                                                    ->join('mises','souscriptions.mise_id','=','mises.id')
                                                    ->select('clients.nom','clients.prenoms','mises.montant','souscriptions.id','souscriptions.solde','souscriptions.statut')
                                                    ->get();
        $title = "Souscriptions";
        return view('suscribes',compact('mises', 'clients', 'title','suscribes'));
    }

    function storeSuscribe()
    {
        $client = Client::find(request('client'));
        $mise = Mise::find(request('mise'));
        $debut = Carbon::now()->toDateTimeString();
        $fin = Carbon::now()->addDays($mise->duree)->toDateTimeString();
        $suscribe = new Souscription();
        $suscribe->client_id = $client->id;
        $suscribe->mise_id = $mise->id;
        $suscribe->solde_final = $mise->montant * $mise->duree;
        $suscribe->solde = 0;
        $suscribe->debut = $debut;
        $suscribe->fin = $fin;
        $suscribe->statut = 0;
        $suscribe->save();
        return redirect('suscribes')->with('success', 'Souscription réussie');
    }

    function deleteSuscribe($id)
    {
        Souscription::destroy($id);
        return back()->with('success','Cette souscription a été correctement supprimée');
    }

    function payements()
    {
        $mises = Mise::all();
        $payements = Payement::join('souscriptions','payements.souscription_id','=','souscriptions.id')
                                                ->join('mises','souscriptions.mise_id','=','mises.id')
                                                ->join('clients','souscriptions.client_id','=','clients.id')
                                                ->select('clients.nom','clients.prenoms','mises.montant','souscriptions.id','souscriptions.solde','payements.created_at')
                                                ->get();
        $title = "Payements";
        return view('payements',compact('mises','payements','title'));
    }

    function getClients()
    {
        $mise = Mise::find(request('mise'));
        $clients = Souscription::join('mises','souscriptions.mise_id','=','mises.id')
                                              ->join('clients','souscriptions.client_id','=','clients.id')
                                              ->select('clients.id','clients.nom','clients.prenoms')
                                              ->where('souscriptions.mise_id',$mise->id)
                                              ->where('statut',0)
                                              ->get();
        $output = '<option >Choisir le client</option>';
        foreach ($clients as $client) {
            $output .= '<option value="' . $client->id . '">' . $client->nom.' '.$client->prenoms . '</option>';
        }
        echo $output;
    }

    function deletePayment($id)
    {
        Utilisateur::destroy($id);
        return back()->with('success','Cet utilisateur a été correctement supprimé');
    }

    function storePayment()
    {
        $suscribe = Souscription::where(
                [
                    ['mise_id',request('mise')],
                    ['client_id',request('client')],
                    ['statut',0]
                ])->first();
        $mise = Mise::find(request('mise'));
        $pay = new Payement();
        $pay->souscription_id = $suscribe->id;
        $pay->save();
        $this->setStatus($suscribe->id,$mise->montant);
        return redirect('/payements')->with('success','Payement enregistré avec succès');
    }

    function setStatus($souscription_id,$montant)
    {
        $souscription = Souscription::find($souscription_id);
        if(($souscription->solde+$montant) == $souscription->solde_final)
        {
            $souscription->solde = $souscription->solde+$montant;
            $souscription->statut = 1;
        }
        else
        {
            $souscription->solde = $souscription->solde+$montant;
            $souscription->statut = 0;
        }
        $souscription->save();
    }

}
