@extends('layouts.app')
@section('content')
<div class="container">
    <center><h4 class="">Beheer de dokter van een gebruiker</h4></center>
    <br/>
    @if($dokter)
    <center><p>De gebruiker {{ $user->firstName.' '.$user->lastName }} is gelinked aan de volgende dokter: </p></center>
    <br/>
    <table class="table table-bordered">
        <tr>
          <td>Email</td>
          <td>Naam</td>
          <td>Unlink</td>
        </tr>
        <tr>
            <td>{{ $dokter->email }}</td>
            <td>{{ $dokter->firstName.' '.$dokter->lastName }}</td>
            <td>
              <form method="POST" action="{{ url('/user/unlinkDokter') }}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="buddy" value="{{ $user->id }}"/>
                <input class="btn btn-primary" type="submit" name="submit" value="Unlink"/>
              </form>
            </td>
        </tr>
    </table>
    @endif
    @if(!$dokters->isEmpty())
    <br/>
    <form class="form-horizontal  col-md-8 col-md-offset-2" method="POST" action="/user/linkDokter">
    <input type="hidden" name="user" value="{{ $user->id }}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="form-group">
      <label for="buddy" class="col-sm-2 control-label">Dokters</label>
      <div class="col-sm-6">
        <select class="form-control" name="dokter">
        @foreach ($dokters as $u)
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
@endsection
