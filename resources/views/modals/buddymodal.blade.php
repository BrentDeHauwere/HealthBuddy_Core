@extends('layouts.app')
@section('content')
<div class="container">
      <center><h4 class="">Beheer de buddies van een gebruiker</h4></center>
      @if(!$buddies->isEmpty())
        <table class="table table-bordered">
            <tr>
              <td>Email</td>
              <td>Naam</td>
              <td>Unlink</td>
            </tr>
            @foreach($buddies as $buddy)
              <tr>
                <td>{{ $buddy->email }}</td>
                <td>{{ $buddy->firstName.' '.$buddy->lastName }}</td>
                <td>
                  <form method="POST" action="{{ url('/user/unlink') }}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="buddy" value="{{ $buddy->id }}"/>
                    <input class="btn btn-primary" type="submit" name="submit" value="Unlink"/>
                  </form>
                </td>
              </tr>
            @endforeach
        </table>
      @endif
      @if(!$users->isEmpty())
      <br/>
      <form class="form-horizontal" method="POST" action="/user/linkBuddy">
      <input type="hidden" name="user" value="{{ $user->id }}">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <div class="form-group">
        <label for="buddy" class="col-sm-2 control-label">Buddy</label>
        <div class="col-sm-6">
          <select class="form-control" name="buddy">
          @foreach ($users as $u)
            <option value="{{$u->id}}">{{$u->firstName}} {{$u->lastName}}</option>
          @endforeach
          </select>

        </div>
        <div class="col-sm-4">
          <input type="submit" class="btn btn-primary" name="submit" value="Link"/>
        </div>
      </div>
      </form>
      @endif
</div>

</div>
@endsection
