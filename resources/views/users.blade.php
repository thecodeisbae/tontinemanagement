@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nouvel utilisateur</p><hr>
              </div>
              <form action="/user" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Identifiant</label>
                    <input class="form-control" type="text" name="login">
                </div>
                <div class="form-group">
                    <label for="montant">Mot de passe</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="form-group">
                    <label for="montant">Rôle</label>
                    <select name="role" id="" class="form-control">
                        <option value="1">User</option>
                        <option value="0">Admin</option>
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
            <h6>Liste des utilisateurs</h6>
          </div>
          <div class="card-body p-5">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size:80%;" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Identifiant</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$user)
                            <tr>
                                <td align="center">{{ $key+1 }}</td>
                                <td align="center">{{ $user->login }}</td>
                                <td align="center">{{ $user->role == '0' ? 'Admin' : 'User' }}</td>
                                <td align="center">
                                    <a  href="/user/edit/{{ $user->id }}">Editer</a><br>
                                    <a onclick="return confirm('Confirmer la suppression de cet utilisateur ?');"  href="/user/delete/{{ $user->id }}">Supprimer</a>
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
