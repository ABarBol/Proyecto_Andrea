@extends('layouts.global')

@section('title', 'Calendar create')

@section('content')
    <h1>Crear Calendar</h1>
    <form action="{{ route('calendars.store') }}" method="POST">

        @csrf

        <label>
            Nombre:
            <input type="text" name="name" value="{{ old('name') }}">
        </label>
        <button type="submit">Crear calendario</button>
        @error('name')
            <br>
            <span style="color:red"> {{ $message }} </span>
        @enderror
    </form>
@endsection
