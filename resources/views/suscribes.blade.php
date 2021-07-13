@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nouvelle souscription</p><hr>
              </div>
              <form action="/suscribe" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Client</label>
                    <select name="client" id="" class="form-control">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom.' '.$client->prenoms }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="montant">Mise</label>
                    <select name="mise" id="" class="form-control">
                        @foreach ($mises as $mise)
                            <option value="{{ $mise->id }}">{{ $mise->montant }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                </div>
                </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Liste des souscriptions</h6>
          </div>
          <div class="card-body p-5">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size:80%;" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom Prénoms du Client</th>
                            <th>Mise</th>
                            <th>Solde</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suscribes as $key=>$suscribe)
                            <tr>
                                <td align="center">{{ $key+1 }}</td>
                                <td align="center">{{ $suscribe->nom.' '.$suscribe->prenoms }}</td>
                                <td align="center">{{ $suscribe->montant }}</td>
                                <td align="center">{{ $suscribe->solde }}</td>
                                <td align="center">{{ $suscribe->statut == '1' ? 'Clôturer' : 'En cours' }}</td>
                                <td align="center">
                                    <a onclick="return confirm('Confirmer la suppression de cette souscription ?');"  href="/suscribe/delete/{{ $suscribe->id }}">Supprimer</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $( document ).ready(function() {
        $('#dataTable_previous').children("a").text('Prev');
    });
    $('#dataTable').dataTable();
  </script>
@endsection
