<div class="modal-dialog">
  <!-- Modal content-->
  <form class="form-horizontal" method="POST" action="user/linkBuddy">
  <input type="hidden" name="user" value="{{ $user->id }}">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Link a buddy to a user</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
          <label for="buddy" class="col-sm-2 control-label">Buddy</label>
          <div class="col-sm-10">
            <select class="form-control" name="buddy">
            @foreach ($users as $u)
              <option value="{{$u->id}}">{{$u->firstName}} {{$u->lastName}}</option>
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
