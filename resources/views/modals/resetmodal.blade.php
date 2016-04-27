@extends('layouts.app')
@section('content')
<div class="container">
  <!-- Modal content-->
  <form class="form-horizontal col-md-8 col-md-offset-2" method="POST" action="/user/reset">
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <center><h4 class="col-sm-10 col-sm-offset-2">Verander het wachtwoord van een gebruiker</h4></center>

        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Wachtwoord</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord" value="{{ old('password') }}">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>

            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-2 control-label">Herhaal</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Wachtwoord" value="{{ old('confirm') }}">
            @if ($errors->has('confirm'))
                <span class="help-block">
                    <strong>{{ $errors->first('confirm') }}</strong>
                </span>

            @endif
          </div>
        </div>
      <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit"/>
        </div>
      </div>
  </form>
</div>
@endsection
