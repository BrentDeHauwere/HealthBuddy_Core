@extends('layouts.app')

@section('header')
    <meta id="token" content={{ csrf_token() }} />
    <style>
#devices {
  width: 90%;
  margin-left: 5%;
}
table {
    margin-top: 30px;
}
.list {
  font-family:sans-serif;
}
td {
  padding:10px;
  border:solid 1px #eee;
}
.remove {
    margin: 0 auto;
    display: block !important;
}
input {
  border-radius: 25px;
  padding: 7px 14px;
  background-color: transparent;
  border: solid 1px rgba(255, 255, 255, 0.2);
  width: 100%;
  box-sizing: border-box;
  color: #fff;
  margin-bottom: 30px !important;
  border-color:#aaa;
}
input:focus {
  outline:none;
  border-color:#aaa;
}
.sort {
  padding:0px 30px;
  border-radius: 6px;
  border:none;
  display:inline-block;
  color:#fff;
  text-decoration: none;
  background-color: #9ccf58;
  height:30px;
  margin: 5px 5px 0 0;
}
.sort:hover {
  text-decoration: none;
  background-color: rgb(78, 79, 80);;
}
.sort:focus {
  outline:none;
}
.sort:after {
  display:inline-block;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid transparent;
  content:"";
  position: relative;
  top:-10px;
  right:-5px;
}
.sort.asc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #fff;
  content:"";
  position: relative;
  top:4px;
  right:-5px;
}
.sort.desc:after {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #fff;
  content:"";
  position: relative;
  top:-4px;
  right:-5px;
}
    </style>
@endsection

@section('content')
    <div class="col-md-12" id="devices">
        <input class="search" placeholder="Search" />
        <button class="sort" data-sort="deviceId">Soorteer op apparaat ID</button>
        <button class="sort" data-sort="deviceType">Soorteer op apparaattype</button>
        <button class="sort" data-sort="firstName">Soorteer op voornaam</button>
        <button class="sort" data-sort="lastName">Soorteer op familienaam</button>
        <button class="sort" data-sort="email">Soorteer op email</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Apparaat ID</th>
                  <th>Apparaattype</th>
                  <th>Toegewezen aan</th>
                  <th></th>
                  <th>Emailadres</th>
                  <th>Verwijderen</th>
                </tr>
            </thead>
            <!-- IMPORTANT, class="list" have to be at tbody -->
            <tbody class="list">
                @foreach ($devices as $device)
                    <tr>
                      <td class="deviceId">{{ $device->id }}</td>
                      <td class="deviceType">{{ $device->type }}</td>
                      @if (isset($device->user))
                          <td class="firstName">{{ $device->user->firstName }}</td>
                          <td class="lastName">{{ $device->user->lastName }}</td>
                          <td class="email">{{ $device->user->email }}</td>
                      @else
                          <td class="firstName">-</td>
                          <td class="lastName">-</td>
                          <td class="email">-</td>
                      @endif
                      <td>
                          <form class="form-horizontal" action="{{ action('DeviceController@destroy', ['device' => "$device->id"]) }}" method="post">
                              <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                              <input name="_method" type="hidden" value="DELETE">
                              <button type="submit" class="btn btn-primary remove">Verwijderen</button>
                          </form>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer')
    <script src="http://listjs.com/no-cdn/list.js"></script>
    <script type="text/javascript">
    var options = {
        valueNames: [ 'deviceId', 'deviceType', 'firstName', 'lastName', 'email' ]
    };

    var userList = new List('devices', options);
    </script>
@endsection
