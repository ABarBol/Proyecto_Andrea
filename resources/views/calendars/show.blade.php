@extends('layouts.global')

@section('title', 'Calendar ' . $calendar->name)

@section('content')
    <h1>Este es el {{ $calendar->name }}</h1>
    <a href="{{ route('calendars.index')}}">Volver al indice</a>
    <a href="{{ route('calendars.edit', $calendar)}}">Editar</a>
    <p><strong>Categoria: </strong> {{ $calendar->id }}</p>

    <form action="{{route('calendars.destroy', $calendar)}}" method="POST">

        @csrf

        @method('delete')

        <button type="submit">Eliminar</button>
    </form>



@endsection
