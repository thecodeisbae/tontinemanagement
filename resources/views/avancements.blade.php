@extends('app/layout')
@section('contents')
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-12">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Nouvel avancement</p><hr>
              </div>
              <form action="/avancement" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Client</label>
                    <select name="client" id="client" class="form-control">
                        <option>Selectionner le client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom .' '.$client->prenoms }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="montant">Mise</label>
                    <select name="mise" id="mise" class="form-control">
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Valider</button>
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
            <h6>Liste des avancements</h6>
          </div>
          <div class="card-body p-5">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size:80%;" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom Prénoms du client</th>
                            <th>Montant avancé</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($avancements as $key=>$avancement)
                            <tr>
                                <td align="center">{{ $key+1 }}</td>
                                <td align="center">{{ $avancement->nom.' '.$avancement->prenoms }}</td>
                                <td align="center">{{ $avancement->solde_final }}</td>
                                <td align="center">{{ $avancement->created_at }}</td>
                                <td align="center">{{ $avancement->statut == '0' ? 'En cours' : 'Clôturer' }}</td>
                                <td align="center">
                                    <a onclick="return confirm('Confirmer la suppression de cet avancement ?');"  href="/avancement/delete/{{ $avancement->id }}">Supprimer</a>
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
        $('#dataTable').dataTable();
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        $(function () {
            $('#dataTable_previous').children("a").text('Prev');
            $('#client').change(
                function ()
                {
                    $('#mise').html();
                    if($(this).val() != '')
                        {
                        $.ajax({
                            type: "post",
                            url: "/getMisesByClient",
                            data: {client:$('#client').val()},
                            success: function (response) {
                                $('#mise').html(response);
                            }
                        });
                    }
                }
            );
        });



  </script>
@endsection
