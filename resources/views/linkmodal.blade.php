<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Link a user to a device</h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="user" class="col-sm-2 control-label">User</label>
          <div class="col-sm-10">
            <select class="form-control" name="user">
              <option>User</option>
              <option>User2</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="device" class="col-sm-2 control-label">Device</label>
          <div class="col-sm-10">
            <select class="form-control" name="device">
              <option>Device1</option>
              <option>Device2</option>
            </select>
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