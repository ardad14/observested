@extends('layouts.mainLayout')

@section('content')
    <div id="app">
        <clients
            clients="{{ $clients }}"
        />
    </div>
@endsection
