@extends('layouts.global')

@section('title', 'Calendar')

@section('content')
    <h1>Todos los calendarios</h1>
    <a href="{{ route('calendars.create') }}">Crear calendar</a>
    <ul>
        @foreach ($calendars as $calendar)
            <li>
                <a href="{{ route('calendars.show', $calendar->id) }}">{{ $calendar->name }}</a>
            </li>
        @endforeach
    </ul>

    {{ $calendars->links() }}
@endsection
