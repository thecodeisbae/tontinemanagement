@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nouvelle mise</p><hr>
              </div>
              <form action="/mise" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Montant de la mise</label>
                    <input id="montant" class="form-control" type="number" name="montant">
                </div>
                <div class="form-group">
                    <label for="duree">Durée en jours</label>
                    <input id="duree" class="form-control" type="number" name="duree">
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
            <h6>Liste des mises</h6>
          </div>
          <div class="card-body p-5">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size:80%;" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Montant de la mise</th>
                            <th>Durée en nombre de jours</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mises as $key=>$mise)
                            <tr>
                                <td align="center">{{ $key+1 }}</td>
                                <td align="center">{{ $mise->montant }}</td>
                                <td align="center">{{ $mise->duree }} jours</td>
                                <td align="center">
                                    <a  href="/mise/edit/{{ $mise->id }}">Editer</a><br>
                                    <a onclick="return confirm('Confirmer la suppression de cette mise ?');"  href="/mise/delete/{{ $mise->id }}">Supprimer</a>
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
