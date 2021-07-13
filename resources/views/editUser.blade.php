@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Mettre à jour des informations</p><hr>
              </div>
              <form action="/user/edit/{{ $user->id }}" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Identifiant</label>
                    <input class="form-control" type="text" name="login" value="{{ $user->login }}">
                </div>
                <div class="form-group">
                    <label for="montant">Mot de passe</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="montant">Rôle</label>
                    <select name="role" id="" class="form-control">
                        <option {{ $user->role == '1' ? 'selected' : '' }} value="1">User</option>
                        <option {{ $user->role == '0' ? 'selected' : '' }} value="0">Admin</option>
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
@endsection
