@extends('layouts.global')

@section('title', 'Calendar create')

@section('content')
    <h1>Crear Calendar</h1>
    <form action="{{route('calendars.store')}}" method="POST">

        @csrf

        <label>
            Nombre:
            <input type="text" name="name">
        </label>
        <button type="submit">Crear calendario</button>
    </form>
@endsection
