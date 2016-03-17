<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal" id="AddForm" novalidate="novalidate" >
  <!--<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add a new user</h4>
    </div>
    <div class="modal-body">

         <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">First Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Last Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-2 control-label">Confirm</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm">
          </div>
        </div>
        <div class="form-group">
          <label for="date" class="col-sm-2 control-label">Date of birth</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Gender</label>
          <div class="col-sm-10">
            <select class="form-control" id="gender" name="gender">
              <option>M</option>
              <option>V</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="role" class="col-sm-2 control-label">Role</label>
          <div class="col-sm-10">
            <select class="form-control" id="role" name="role">
              <option>Zorgbehoevende</option>
              <option>ZorgMantel</option>
            </select>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" id="submitAdd" class="btn btn-primary">Next</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  </form>
</div>
