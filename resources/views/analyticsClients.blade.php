@extends('layouts.mainLayout')

@section('content')
    <div id="app">
        <analytics-clients
            actions="{{ $actions }}"
        />
    </div>
@endsection
