@extends('layouts.global')

@section('title', 'Calendar edit')

@section('content')
    <h1>Editar Calendar</h1>
    <form action="{{ route('calendars.update', $group) }}" method="POST">

        @csrf

        @method('put')

        <label>
            Nombre:
            <input type="text" name="name" value="{{ $group->name }}">
        </label>
        <button type="submit">Editar calendario</button>

    </form>
@endsection
