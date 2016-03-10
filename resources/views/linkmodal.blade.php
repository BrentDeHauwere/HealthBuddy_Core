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
