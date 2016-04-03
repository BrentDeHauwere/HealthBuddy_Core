<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal" method="POST" action="user/reset">
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Verander het wachtwoord van een gebruiker</h4>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Wachtwoord</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-2 control-label">Herhaal</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Wachtwoord">
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>

      <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
    </div>
  </div>
  </form>
</div>
