@extends('layouts.app')
@section('content')
  <div class="container">
  <form class="form-horizontal col-md-8 col-md-offset-2" method="POST" action="/user/editAddress">
  <input type="hidden" name="id" value="{{$address->id}}">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <center><h4 class="col-sm-10 col-sm-offset-2">Edit een gebruiker</h4></center>
         
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit"/>
      </div>
    </div>
  </form>
</div>
@endsection
