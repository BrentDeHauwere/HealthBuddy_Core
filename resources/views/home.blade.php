@extends('layouts.app')
@section('header')
  <meta id="token" content={{ csrf_token() }} />
  <!--<meta id="token" content="niks" />-->
@endsection
@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
      <legend><h3 class="text-center">User Beheer</h3></legend>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-10">
            <button id="AddUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">Add User</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <tr>
              <td>Name</td>
              <td>Address</td>
              <td>Postal</td>
              <td>Country</td>
              <td>Gender</td>
              <td>Date of birth</td>
              <td>Email</td>
              <td>Role</td>
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
                  <td>{{ $user->role }}</td>
                  <td>
                      <button type="button" class="btn btn-primary EditUser"  data-target="#EditModal">Edit</button>
                      <button type="button" class="btn btn-primary ResetPass"  data-target="#ResetModal">Password</button>
                      <button type="button" class="btn btn-primary LinkDev"  data-target="#LinkModal">Devices</button>
                      <input type="hidden" value="{{ $user->id }}" name="ID"/>
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
  $(document).ready(function(){
        $("#AddUser").on("click", function(e){
          console.log(this);
          ajaxCall(this,"","/addmodal");
        });
        $(".EditUser").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();
          ajaxCall(this,data,"/editmodal");
        });
        $(".ResetPass").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();

          ajaxCall(this,data,"/resetmodal");
        });
        $(".LinkDev").on("click", function(e){
          console.log(this);
          var data = $(this).siblings('input').val();
          ajaxCall(this,data,"/linkmodal");
        });
  });
  function ajaxCall(button,data,url){
    var d = data;
    $.ajax({
      type: "POST",
      url: url,
      beforeSend: function (xhr) {
            var token = $('#token').attr('content');
            console.log(token);
            if (token) {
                  console.log("token");
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
      },
      data: {data: d},
      cache: false,
      success: function(data){
          console.log(button);
         $("#modal").html(data);
         $('#modal').modal('show');
      },
      error: function(error){
        console.log("error");
        $("#modal").html("Something went wrong");
        $('#modal').modal('show');
      }
    });

  }
</script>
@endsection
