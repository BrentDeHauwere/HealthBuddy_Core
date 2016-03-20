@extends('layouts.app')

@section('header')
    <style>
        form {
            width: 90%;
            margin-left: 5%;
        }
        label {
            margin-bottom: 5px !important;
        }
        input, select {
            margin-bottom: 15px !important;
        }
        button {
            float: right;
        }
    </style>
@endsection

@section('content')
    <form class="form-horizontal" action="{{ action('DeviceController@store') }}" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <label class="control-label" for="id">Apparaat ID</label>
        <input class="form-control" type="number" name="id" required>
        <label class="control-label" for="type">Apparaattype</label>
        <select class="form-control" name="type" required>
            @foreach($possibleTypes as $type)
                <option>{{ $type }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
@endsection
