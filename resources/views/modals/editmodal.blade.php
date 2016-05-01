@extends('layouts.app')
@section('content')
  <!-- Modal content-->
  <div class="container">
  <form class="form-horizontal  col-md-8 col-md-offset-2" method="POST" action="/user/editUser">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <center><h4 class="col-sm-10 col-sm-offset-2">Edit een gebruiker</h4></center>
         <input type="hidden" name="id" id="id" value="{{ $user->id }}">
         <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">Voornaam</label>
          <div class="col-sm-10">
            @if ($errors->has('firstname'))
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
            @else
              <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstName }}">
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">Achternaam</label>
          <div class="col-sm-10">
            @if ($errors->has('lastname'))
                <input type="text" class="form-control" id="email" name="lastname" value="{{ old('lastname') }}">
                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @else
              <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastName }}">
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="date" class="col-sm-2 control-label">Geboortedatum</label>
          <div class="col-sm-10">
            @if ($errors->has('date'))
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
                <span class="help-block">
                    <strong>{{ $errors->first('date') }}</strong>
                </span>
            @else
              <input type="date" class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" value="{{ $user->dateOfBirth }}">
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            @if ($errors->has('email'))
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @else
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">Telefoon</label>
          <div class="col-sm-10">
            @if ($errors->has('phone'))
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @else
              <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
            @endif
          </div>
        </div>
        <div class="form-group">
          <label for="gender" class="col-sm-2 control-label">Geslacht</label>
          <div class="col-sm-10">
            <select class="form-control" id="gender" name="gender">
              <option>{{ $user->gender }}</option>
              <option>M</option>
              <option>V</option>
              @if ($errors->has('gender'))
                  <span class="help-block">
                      <strong>{{ $errors->first('gender') }}</strong>
                  </span>
              @endif
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="role" class="col-sm-2 control-label">Rol</label>
          <div class="col-sm-10">
            <select class="form-control" id="role" name="role">
              <option>{{ $user->role }}</option>
              <option>Zorgbehoevende</option>
              <option>Zorgmantel</option>
              <option>Zorgwinkel</option>
              @if ($errors->has('role'))
                  <span class="help-block">
                      <strong>{{ $errors->first('role') }}</strong>
                  </span>
              @endif
            </select>
          </div>
        </div>
        <div class="form-group">
         <label for="street" class="col-sm-2 control-label">Straat</label>
         <div class="col-sm-10">
           @if ($errors->has('street'))
               <input type="text" class="form-control" id="street" name="street" placeholder="Straat" value="{{ old('street')}}">
               <span class="help-block">
                   <strong>{{ $errors->first('street') }}</strong>
               </span>
           @else
             <input type="text" class="form-control" id="street" name="street" placeholder="Straat" value="{{$address->street}}">
           @endif
         </div>
       </div>
       <div class="form-group">
        <label for="streetnumber" class="col-sm-2 control-label">Huisnummer</label>
        <div class="col-sm-10">
          @if ($errors->has('streetnumber'))
              <input type="text" class="form-control" id="streetnumber" name="streetnumber" placeholder="Huisnummer" value="{{old('streetnumber')}}">
              <span class="help-block">
                  <strong>{{ $errors->first('streetnumber') }}</strong>
              </span>
          @else
             <input type="text" class="form-control" id="streetnumber" name="streetnumber" placeholder="Huisnummer" value="{{$address->streetNumber}}">
          @endif
        </div>
      </div>
      <div class="form-group">
       <label for="bus" class="col-sm-2 control-label">Bus</label>
       <div class="col-sm-10">
         @if ($errors->has('bus'))
             <input type="text" class="form-control" id="bus" name="bus" placeholder="Bus" value="{{old('bus')}}">
             <span class="help-block">
                 <strong>{{ $errors->first('bus') }}</strong>
             </span>
         @else
             <input type="text" class="form-control" id="bus" name="bus" placeholder="Bus" value="{{$address->bus}}">
         @endif
       </div>
     </div>
      <div class="form-group">
       <label for="zipcode" class="col-sm-2 control-label">Postcode</label>
       <div class="col-sm-10">
         @if ($errors->has('zipcode'))
             <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postcode" value="{{old('zipcode')}}">
             <span class="help-block">
                 <strong>{{ $errors->first('zipcode') }}</strong>
             </span>
         @else
             <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postcode" value="{{$address->zipCode}}">
         @endif
       </div>
     </div>
     <div class="form-group">
      <label for="city" class="col-sm-2 control-label">Stad</label>
      <div class="col-sm-10">

        @if ($errors->has('city'))
            <input type="text" class="form-control" id="city" name="city" placeholder="Stad" value="{{old('city')}}">
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @else
            <input type="text" class="form-control" id="city" name="city" placeholder="Stad" value="{{$address->city}}">
        @endif
      </div>
    </div>
    <div class="form-group">
     <label for="country" class="col-sm-2 control-label">Land</label>
     <div class="col-sm-10">

       @if ($errors->has('country'))
           <input type="text" class="form-control" id="country" name="country" placeholder="Land" value="{{old('country')}}">
           <span class="help-block">
               <strong>{{ $errors->first('country') }}</strong>
           </span>
       @else
           <input type="text" class="form-control" id="country" name="country" placeholder="Land" value="{{$address->country}}">
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
