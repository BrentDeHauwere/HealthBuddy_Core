@extends('layouts.app')
@section('content')
<div class="container">
  <!-- Modal content-->
  <form class="form-horizontal" method="POST" action="/user/addAddress">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <center><h4 class="col-sm-10 col-sm-offset-2">Voeg een niewe gebruiker toe</h4></center>

         
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit"/>
      </div>
    </div>
  </form>
</div>
@endsection
