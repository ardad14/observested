@extends('layouts.mainLayout')

@section('content')
    <div id="app">
        <projects-list
            :projects="{{ $projects }}"
            :user="{{ $userId }}"
            select="{{ $select ?? ""}}"
        />
    </div>
@endsection
