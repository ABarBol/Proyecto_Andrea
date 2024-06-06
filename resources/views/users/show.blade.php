@extends('layouts.global')

@section('title', 'Usuario  ' . $user->name)

@section('content')
    <h1>Este es el {{ $user->name }}</h1>
    <a href="{{ route('users.index')}}">Volver al indice</a>
    <a href="{{ route('users.edit', $user)}}">Editar</a>
    <p><strong>Categoria: </strong> {{ $user->id }}</p>

    <form action="{{route('users.destroy', $user)}}" method="POST">

        @csrf

        @method('delete')

        <button type="submit">Eliminar</button>
    </form>



@endsection
