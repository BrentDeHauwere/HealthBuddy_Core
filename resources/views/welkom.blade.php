@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welkom in de ZorgWinkel!</div>

                <div class="panel-body">
                @if (Auth::check())
                    U bent ingelogd !
                @else
                Gelieve in te loggen alvorens verder te gaan.
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
