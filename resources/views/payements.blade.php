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
              <form action="/payement" method="post" class="m-4">
                @csrf
                <div class="form-group">
                    <label for="montant">Mise</label>
                    <select name="mise" id="mise" class="form-control">
                        <option>Selectionner la mise</option>
                        @foreach ($mises as $mise)
                            <option value="{{ $mise->id }}">{{ $mise->montant }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="montant">Client</label>
                    <select name="client" id="client" class="form-control">
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
            <h6>Liste des payements</h6>
          </div>
          <div class="card-body p-5">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size:80%;" id="dataTable" width="100%" cellspacing="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom Prénoms du client</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payements as $key=>$payment)
                            <tr>
                                <td align="center">{{ $key+1 }}</td>
                                <td align="center">{{ $payment->nom.' '.$payment->prenoms }}</td>
                                <td align="center">{{ $payment->montant }}</td>
                                <td align="center">{{ $payment->created_at }}</td>
                                <td align="center">
                                    <a onclick="return confirm('Confirmer la suppression de ce payement ?');"  href="/payement/delete/{{ $payment->id }}">Supprimer</a>
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
            $('#mise').change(
                function ()
                {
                    if($(this).val() != '')
                        {
                        $.ajax({
                            type: "post",
                            url: "/getClients",
                            data: {mise:$('#mise').val()},
                            success: function (response) {
                                $('#client').html(response);
                            }
                        });
                    }
                }
            );
        });



  </script>
@endsection
