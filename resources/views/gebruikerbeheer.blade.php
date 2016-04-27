@extends('layouts.app')
@section('header')
  <meta id="token" content={{ csrf_token() }} />
  <!--<meta id="token" content="niks" />-->
  <style>
  .modal-backdrop
  {
      opacity:0 !important;
  }
  .alert{
    animation: opa 1s;
  }

  @keyframes opa {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}
  </style>
@endsection
@section('content')

@if(session('response'))
<div class="col-md-6 col-md-offset-3">
  <div class="alert alert-warning fade in">
    <strong>Warning!</strong> {{ session('response') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
</div>
@elseif(session('success'))
<div class="col-md-6 col-md-offset-3">
  <div class="alert alert-success fade in">
    <strong>Success!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
</div>
@endif

<div class="container nowidth">
    <div class="col-md-10 col-md-offset-1">
      <legend><h3 class="text-center">Gebruikerbeheer</h3></legend>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-10">
            <button id="AddUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">Voeg een user toe</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <tr>
              <td>Naam</td>
              <td>Adres</td>
              <td>Postcode</td>
              <td>Land</td>
              <td>M/V</td>
              <td>Geboortedatum</td>
              <td>Email</td>
              <td>Telefoon</td>
              <td>Rol</td>
              <td>Opties</td>
            </tr>
            @foreach ($users as $user)
                <tr>
                  <td>{{ $user->firstName.' '.$user->lastName }}</td>
                  <td>{{ $user->address->street." ".$user->address->streetNumber }}</td>
                  <td>{{ $user->address->city." ".$user->address->zipCode  }}</td>
                  <td>{{ $user->address->country }}</td>
                  <td>{{ $user->gender }}</td>
                  <td>{{ $user->dateOfBirth }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                      <button type="button" class="btn btn-primary EditUser"  data-target="#EditModal">Edit</button>
                      <button type="button" class="btn btn-primary ResetPass"  data-target="#ResetModal">Wachtwoord</button>
                      <button type="button" class="btn btn-primary LinkDev"  data-target="#LinkModal">Toestellen</button>
                      @if ($user->role == 'Zorgmantel')
                        <button type="button" class="btn btn-primary LinkBuddy">Patiënten</button>
                      @endif
                      <input type="hidden" value="{{ $user->id }}" name="ID"/>
                      <form method="POST" action="user/delete">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input class="btn btn-primary" type="submit" name="delete" value="Verwijder"/>
                        <input type="hidden" value="{{ $user->id }}" name="ID"/>
                      </form>
                  </td>
                </tr>
            @endforeach
          </table>
        </div>
    </div>
</div>
<div id="modal" class="modal fade" role="dialog"></div>
@endsection
@section('footer')
<script type="text/javascript">
  $(document).on('click', '#submitAdd', function() {
    console.log('something');
    var fm = $('#firstname').val();
    var lm = $('#lastname').val();
    var pw = $('#password').val();
    console.log(pw);
    var cf = $('#confirm').val();
    var date = $('#date').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var gender = $('#gender').val();
    var role = $('#role').val();
    var data = {"firstname":fm,"lastname":lm,"password":pw,"confirm":cf,"date":date,"email":email,"phone":phone,"gender":gender,"role":role};
    console.log(data);
    ajaxCall(data,"/user/add");
  });

  $(document).on('click', '#submitEdit', function() {
    console.log('something');
    var fm = $('#firstname').val();
    var lm = $('#lastname').val();
    var date = $('#date').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var gender = $('#gender').val();
    var role = $('#role').val();
    var dataID = $('#id').val();
    var data = {"id":dataID,"firstname":fm,"lastname":lm,"date":date,"email":email,"phone":phone,"gender":gender,"role":role};
    console.log(data);
    ajaxCall(data,"/user/editUser");
  });

  $(document).ready(function(){
        $("#AddUser").on("click", function(e){
          console.log(this);
          ajaxCall("","/addmodal");
        });
        $(".EditUser").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();
          ajaxCall(data,"/editmodal");
        });
        $(".ResetPass").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();

          ajaxCall(data,"/resetmodal");
        });
        $(".LinkDev").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();
          ajaxCall(data,"/linkmodal");
        });
        $(".LinkBuddy").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();
          ajaxCall(data,"/buddymodal");
        });
  });

  function ajaxCall(data,url,bool){
    var d = data;
    $.ajax({
      type: "POST",
      url: url,
      beforeSend: function (xhr) {
            var token = $('#token').attr('content');
            console.log(token);
            if (token) {
                  //console.log("token");
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
      },
      data: {data: d},
      cache: false,
      success: function(data){
          $('#modal').empty();
          $("#modal").html(data);
          $('#modal').modal('show');
      },
      error: function(error){
        console.log("error");
        if(bool){
          $('#modal').empty();
          $("#modal").html("Something went wrong!");
          $('#modal').modal('show');
        }
      }
    });

  }
</script>
@endsection
