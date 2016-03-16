<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit a user</h4>
    </div>
    <div class="modal-body">

         <input type="hidden" name="id" value="{{ $user->id }}">
         <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">First Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstName }}">
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Last Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastName }}">
          </div>
        </div>
        <div class="form-group">
          <label for="date" class="col-sm-2 control-label">Date of birth</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="date" name="date" value="{{ $user->dateOfBirth }}">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Gender</label>
          <div class="col-sm-10">
            <select class="form-control" name="gender">
              <option>{{ $user->gender }}</option>
              <option>M</option>
              <option>V</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="role" class="col-sm-2 control-label">Role</label>
          <div class="col-sm-10">
            <select class="form-control" name="role">
              <option>{{ $user->role }}</option>
              <option>Zorgbehoevende</option>
              <option>ZorgMantel</option>
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>

      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  </form>
</div>
