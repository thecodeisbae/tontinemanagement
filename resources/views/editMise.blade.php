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
              <form action="/mise/edit/{{ $mise->id }}" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Montant de la mise</label>
                    <input id="montant" class="form-control" type="number" name="montant" value="{{ $mise->montant }}">
                </div>
                <div class="form-group">
                    <label for="duree">Durée en jours</label>
                    <input id="duree" class="form-control" type="number" name="duree" value="{{ $mise->duree }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Mise à jour</button>
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
