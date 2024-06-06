@extends('layouts.global')

@section('title', 'Editar Usuario')

@section('content')
    <h1>Editar Usuario</h1>
    <form action="{{ route('users.update', $user) }}" method="POST">

        @csrf

        @method('put')

        <label>
            Nombre:
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
        </label>

        @error('name')
            <span style="color:red"> {{ $message }} </span>
        @enderror


        <button type="submit">Editar usuario</button>

    </form>
@endsection
