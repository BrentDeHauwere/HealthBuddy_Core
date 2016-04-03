@extends('layouts.app')

@section('header')
    <style>
        li {
            color: #a94442 !important;
        }
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
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($succes))
        <div class="alert alert-success">
            <strong>Succesvol!</strong> Het device is succesvol opgeslagen.
        </div>
    @endif

    <form class="form-horizontal" action="{{ action('DeviceController@store') }}" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <label class="control-label" for="id">Serienummer</label>
        <input class="form-control" type="text" name="id" required>
        <label class="control-label" for="type">Apparaattype</label>
        <select class="form-control" name="type" required>
            @foreach($possibleTypes as $type)
                <option>{{ $type }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
@endsection
