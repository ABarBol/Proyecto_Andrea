@extends('layouts.global')

@section('title', 'Calendar edit')

@section('content')
    <h1>Editar Calendar</h1>
    <form action="{{ route('calendars.update', $calendar) }}" method="POST">

        @csrf

        @method('put')

        <label>
            Nombre:
            <input type="text" name="name" value="{{ old('name', $calendar->name) }}">
        </label>

        @error('name')
            <span style="color:red"> {{ $message }} </span>
        @enderror


        <button type="submit">Editar calendario</button>

    </form>
@endsection
