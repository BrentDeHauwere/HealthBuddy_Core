<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Change password of a user</h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
        <input type="hidden" name="id" value="{{ $user->id }}">
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
    </div>
    <div class="modal-footer">
      <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
      </form>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
