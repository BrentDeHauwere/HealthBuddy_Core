<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Beheer de dokter van een gebruiker</h4>
    </div>
    <div class="modal-body">
          <p>De gebruiker {{ $user->firstName.' '.$user->lastName }} is gelinked aan de volgende dokter: </p>
          <br/>
          <table class="table table-bordered">
              <tr>
                <td>Email</td>
                <td>Naam</td>
                <td>Unlink</td>
              </tr>
              <tr>
                  <td>{{ $dokter->email }}</td>
                  <td>{{ $dokter->firstName.' '.$dokter->lastName }}</td>
                  <td>
                    <form method="POST" action="{{ url('user/unlinkDokter') }}">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="hidden" name="buddy" value="{{ $user->id }}"/>
                      <input class="btn btn-primary" type="submit" name="submit" value="Unlink"/>
                    </form>
                  </td>
              </tr>
          </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
    </div>
  </div>

</div>
