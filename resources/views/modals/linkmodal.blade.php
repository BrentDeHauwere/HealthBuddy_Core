@extends('layouts.app')
@section('content')
<div class="container">
  <!-- Modal content-->
  <form class="form-horizontal col-md-8 col-md-offset-2" method="POST" action="/user/link">
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <center><h4 class="col-sm-10 col-sm-offset-2">Link een toestel aan {{ $user->firstName . ' ' . $user->lastName }} </h4></center>

        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="device" class="col-sm-2 control-label">Toestel</label>
          <div class="col-sm-10">
            <select class="form-control" name="device">
              @foreach ($devices as $device)
                <option value="{{ $device->id }}">{{ $device->id }} - {{ $device->type}}</option>
              @endforeach
            </select>
          </div>
        </div>
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit"/>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection
