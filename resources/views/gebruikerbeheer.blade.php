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
  .sort{
    cursor:pointer;
  }
  .search {
    border-radius: 25px;
    padding: 7px 14px;
    background-color: transparent;
    border: solid 1px rgba(255, 255, 255, 0.2);
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 30px !important;
    border-color:#aaa;
  }
  .search:focus {
    outline:none;
    border-color:#aaa;
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
          <a href="/addmodal"><button class="btn btn-primary" type="button" name="add">Voeg een gebruiker toe</button></a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12" id="users">
          <div class="col-md-6"> <input class="search" placeholder="Search" /> </div>
          <div class="col-md-4 col-md-offset-2">
              <select id="rolefilter" class="form-control">
                <option>Alles</option>
                <option>Zorgwinkel</option>
                <option>Zorgbehoevende</option>
                <option>Zorgmantel</option>
              </select>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Naam <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Name"></span></td>
                <th>Adres <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Street"></span></th>
                <th>Postcode <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="City"></span></th>
                <th>Land <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Country"></span></th>
                <th>M/V <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Gender"></span></th>
                <th>Geboortedatum <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="DateOfBirth"></span></th>
                <th>Email <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Email"></span></th>
                <th>Telefoon <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Phone"></span></th>
                <th>Rol <span type="button" class="sort glyphicon glyphicon-triangle-top" data-sort="Role"></span></th>
                <th>Opties</th>
              </tr>
            <thead>
            <tbody class="list">
            @foreach ($users as $user)
                <tr>
                  <td class="Name">{{ $user->firstName.' '.$user->lastName }}</td>
                  <td class="Street">{{ $user->address->street." ".$user->address->streetNumber }}</td>
                  <td class="City">{{ $user->address->city." ".$user->address->zipCode  }}</td>
                  <td class="Country">{{ $user->address->country }}</td>
                  <td class="Gender">{{ $user->gender }}</td>
                  <td class="DateOfBirth">{{ $user->dateOfBirth }}</td>
                  <td class="Email">{{ $user->email }}</td>
                  <td class="Phone">{{ $user->phone }}</td>
                  <td class="Role">{{ $user->role }}</td>
                  <td>
                    <a href="/editmodal/{{$user->id}}"><button class="btn btn-primary" type="button" name="edit">Edit</button></a>
                    <a href="/resetmodal/{{$user->id}}"><button class="btn btn-primary" type="button" name="wachtwoord">Wachtwoord</button></a>
                    <a href="/linkmodal/{{$user->id}}"><button class="btn btn-primary" type="button" name="toestellen">Toestellen</button></a>
                    @if ($user->role == 'Zorgmantel')
                      <a href="/buddymodal/{{$user->id}}"><button class="btn btn-primary" type="button" name="buddies">Buddies</button></a>
                    @elseif ($user->role == 'Zorgbehoevende')
                        <a href="/doktermodal/{{$user->id}}"><button class="btn btn-primary" type="button" name="dokter" value="Dokter">Dokter</button></a>
                    @endif
                    <form method="POST" action="user/delete">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input class="btn btn-primary" type="submit" name="delete" value="Verwijder"/>
                      <input type="hidden" value="{{ $user->id }}" name="ID"/>
                    </form>
                  </td>
                </tr>
            @endforeach
          </tbody>
          </table>
        </div>
    </div>
</div>
<div id="modal" class="modal fade" role="dialog"></div>
@endsection
@section('footer')
<script src="http://listjs.com/no-cdn/list.js"></script>
<script type="text/javascript">
var options = {
    valueNames: [ 'Name','Street','City','Country','Gender','DateOfBirth','Email','Phone','Role' ]
};

var userList = new List('users', options);
$('#rolefilter').change(function () {
    var selection = this.value;

    // filter items in the list
    userList.filter(function (item) {
        if (item.values().Role == selection || selection == "Alles") {
            return true;
        } else {
            return false;
        }
    });

});
</script>
<script type="text/javascript">
  $(document).ready(function(){
        $(".sort").on("click",function(){
          console.log("detected click....");
          if($(this).hasClass('glyphicon glyphicon-triangle-bottom')){
            $(this).removeClass('glyphicon glyphicon-triangle-bottom').addClass('glyphicon glyphicon-triangle-top');
          }
          else if($(this).hasClass('glyphicon glyphicon-triangle-top')){
              $(this).removeClass('glyphicon glyphicon-triangle-top').addClass('glyphicon glyphicon-triangle-bottom');
          }
        });
  });
</script>
@endsection
