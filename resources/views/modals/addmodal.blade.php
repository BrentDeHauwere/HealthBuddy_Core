@extends('layouts.app')
@section('content')
  <!-- Modal content-->
  <div class="container">
  <form class="form-horizontal col-md-8 col-md-offset-2" method="POST" action="/user/add">
  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
  <center><h4 class="col-sm-10 col-sm-offset-2">Voeg een nieuwe gebruiker toe</h4></center>
        <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">Voornaam</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Voornaam" value="{{ old('firstname') }}">

            @if ($errors->has('firstname'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>  
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Achternaam</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Achternaam" value="{{ old('lastname') }}">
            @if ($errors->has('lastname'))

                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @endif
          </div>
        </div>
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
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Herhaal" value="{{ old('confirm') }}">
            @if ($errors->has('confirm'))

                <span class="help-block">
                    <strong>{{ $errors->first('confirm') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="date" class="col-sm-2 control-label">Geboortedatum</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="date" name="date" placeholder="DD/MM/YYY" value="{{ old('date') }}">
            @if ($errors->has('date'))

                <span class="help-block">
                    <strong>{{ $errors->first('date') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Telefoon</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefoon" value="{{ old('phone') }}">
            @if ($errors->has('phone'))

                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>

            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Geslacht</label>
          <div class="col-sm-10">
            <select class="form-control" id="gender" name="gender">
              <option>M</option>
              <option>V</option>
            </select>
            @if ($errors->has('gender'))
                <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="role" class="col-sm-2 control-label">Rol</label>
          <div class="col-sm-10">
            <select class="form-control" id="role" name="role">
              <option>Zorgbehoevende</option>
              <option>Zorgmantel</option>
            </select>
            @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
          </div>
        </div>
          <div class="form-group">
           <label for="street" class="col-sm-2 control-label">Straat</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" id="street" name="street" placeholder="Straat" value="{{ old('street') }}">

             @if ($errors->has('street'))
                 <span class="help-block">
                     <strong>{{ $errors->first('street') }}</strong>
                 </span>
             @endif
           </div>
         </div>
         <div class="form-group">
          <label for="streetnumber" class="col-sm-2 control-label">Huisnummer</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="streetnumber" name="streetnumber" placeholder="Huisnummer" value="{{old('streetnumber')}}">

            @if ($errors->has('streetnumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('streetnumber') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
         <label for="bus" class="col-sm-2 control-label">Bus</label>
         <div class="col-sm-10">
           <input type="text" class="form-control" id="bus" name="bus" placeholder="Bus" value="{{old('bus')}}">
           @if ($errors->has('bus'))

               <span class="help-block">
                   <strong>{{ $errors->first('bus') }}</strong>
               </span>
           @endif
         </div>
       </div>
        <div class="form-group">
         <label for="zipcode" class="col-sm-2 control-label">Postcode</label>
         <div class="col-sm-10">
           <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postcode" value="{{old('zipcode')}}">

           @if ($errors->has('zipcode'))
               <span class="help-block">
                   <strong>{{ $errors->first('zipcode') }}</strong>
               </span>
         @endif
         </div>
       </div>
       <div class="form-group">
        <label for="city" class="col-sm-2 control-label">Stad</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="city" name="city" placeholder="Stad" value="{{old('city')}}">

          @if ($errors->has('city'))
              <span class="help-block">
                  <strong>{{ $errors->first('city') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group">
       <label for="country" class="col-sm-2 control-label">Land</label>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="country" name="country" placeholder="Land" value="{{old('country')}}">

         @if ($errors->has('country'))
             <span class="help-block">
                 <strong>{{ $errors->first('country') }}</strong>
             </span>
         @endif
       </div>
     </div>
        <div class="form-group">
          <div class="col-sm-10 col-sm-offset-2">
            <input type="submit" class="form-control btn btn-primary" value="Voeg Toe">
          </div>
        </div>
      </form>
  </div>
@endsection
