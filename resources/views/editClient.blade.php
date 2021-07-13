@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Mettre à jour les informations</p><hr>
              </div>
              <form action="/client/edit/{{ $client->id }}" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Nom</label>
                    <input class="form-control" type="text" value="{{ $client->nom }}" name="nom">
                </div>
                <div class="form-group">
                    <label for="montant">Prenoms</label>
                    <input class="form-control" value="{{ $client->prenoms }}" type="text" name="prenoms">
                </div>
                <div class="form-group">
                    <label for="montant">Sexe</label>
                    <select name="sexe" id="" class="form-control">
                        <option {{ $client->sexe == 'Homme' ? 'selected' : '' }} value="Homme">Homme</option>
                        <option {{ $client->sexe == 'Femme' ? 'selected' : '' }} value="Femme">Femme</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="duree">Âge</label>
                    <input class="form-control" type="number" value="{{ $client->age }}" name="age">
                </div>
                <div class="form-group">
                    <label for="duree">Contact</label>
                    <input class="form-control" type="tel" value="{{ $client->contact }}" name="contact">
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

@endsection
