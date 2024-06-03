@extends('layouts.global')

@section('title', 'Calendar')

@section('content')
    <h1>Todos los calendarios</h1>
    <a href="{{ route('calendars.create') }}">Crear calendar</a>
    <ul>
        @foreach ($groups as $group)
            <li>
                <a href="{{ route('calendars.show', $group->id) }}">{{ $group->name }}</a>
            </li>
        @endforeach
    </ul>

    {{ $groups->links() }}
@endsection
