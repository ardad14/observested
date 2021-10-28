@extends('layouts.mainLayout')

@section('content')
    <div id="app">
        <board
            :cards="{{ $cards }}"
            project="{{ json_encode($activeProject) ?? ""}}"
        />
    </div>
@endsection
