<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal" id="AddForm" novalidate="novalidate" >
  <!--<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Voeg een nieuwe gebruiker toe</h4>
    </div>
    <div class="modal-body">

         <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">Voornaam</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Voornaam">
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Achternaam</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Achternaam">
          </div>
        </div>
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
        <div class="form-group">
          <label for="date" class="col-sm-2 control-label">Geboortedatum</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="date" name="date" placeholder="Datum">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Telefoon</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefoon">
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Geslacht</label>
          <div class="col-sm-10">
            <select class="form-control" id="gender" name="gender">
              <option>M</option>
              <option>V</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="role" class="col-sm-2 control-label">Rol</label>
          <div class="col-sm-10">
            <select class="form-control" id="role" name="role">
              <option>Zorgbehoevende</option>
              <option>Zorgmantel</option>
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" id="submitAdd" class="btn btn-primary">Volgende</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
    </div>
  </div>
  </form>
</div>
