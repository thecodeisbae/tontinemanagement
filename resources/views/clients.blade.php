@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nouveau client</p><hr>
              </div>
              <form action="/client" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Nom</label>
                    <input class="form-control" type="text" name="nom">
                </div>
                <div class="form-group">
                    <label for="montant">Prenoms</label>
                    <input class="form-control" type="text" name="prenoms">
                </div>
                <div class="form-group">
                    <label for="montant">Sexe</label>
                    <select name="sexe" id="" class="form-control">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="duree">Âge</label>
                    <input class="form-control" type="number" name="age">
                </div>
                <div class="form-group">
                    <label for="duree">Contact</label>
                    <input class="form-control" type="tel" name="contact">
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
            <h6>Liste des clients</h6>
          </div>
          <div class="card-body p-5">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size:80%;" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom Prénoms</th>
                            <th>Sexe</th>
                            <th>Age</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $key=>$client)
                            <tr>
                                <td align="center">{{ $key+1 }}</td>
                                <td align="center">{{ $client->nom.' '.$client->prenoms }}</td>
                                <td align="center">{{ $client->sexe }}</td>
                                <td align="center">{{ $client->age }}</td>
                                <td align="center">{{ $client->contact }}</td>
                                <td align="center">
                                    <a  href="/client/edit/{{ $client->id }}">Editer</a><br>
                                    <a onclick="return confirm('Confirmer la suppression de ce client ?');"  href="/client/delete/{{ $client->id }}">Supprimer</a>
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
