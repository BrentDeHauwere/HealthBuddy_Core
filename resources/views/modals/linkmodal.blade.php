<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal" method="POST" action="user/link">
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Link a user to a device</h4>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="device" class="col-sm-2 control-label">Device</label>
          <div class="col-sm-10">
            <select class="form-control" name="device">
              @foreach ($devices as $device)
                <option value="{{ $device->id }}">{{ $device->id }} - {{ $device->type}}</option>
              @endforeach
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
