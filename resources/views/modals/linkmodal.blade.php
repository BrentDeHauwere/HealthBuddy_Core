@extends('layouts.app')
@section('content')
<div class="container">
  <!-- Modal content-->

  <center><h4 class="col-sm-12">Beheer de toestellen van {{ $user->firstName . ' ' . $user->lastName }} </h4></center>
  @if(!$mydevices->isEmpty())
    @foreach($mydevices as $mydevice)
    <center><p class="col-sm-12">De gebruiker {{ $user->firstName.' '.$user->lastName }} is gelinked aan de volgende toestellen: </p></center>
    <br/>
    <table class="table table-bordered">
        <tr>
          <td>Id</td>
          <td>Type</td>
          <td>Unlink</td>
        </tr>
        <tr>
            <td>{{ $mydevice->id }}</td>
            <td>{{ $mydevice->type }}</td>
            <td>
              <form method="POST" action="{{ url('/user/unlinkDevice') }}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="device" value="{{ $mydevice->id }}"/>
                <input class="btn btn-primary" type="submit" name="submit" value="Unlink"/>
              </form>
            </td>
        </tr>
     </table>
     @endforeach
  @endif
  @if(!$devices->isEmpty())
        <form class="form-horizontal col-md-10" method="POST" action="/user/link">
        <input type="hidden" name="id" value="{{$user->id}}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
  </form>
  @endif
</div>
@endsection
