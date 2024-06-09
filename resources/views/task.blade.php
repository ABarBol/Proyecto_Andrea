@extends('layouts.global')

@section('title', 'Crear tarea')

@section('content')

    <h1 class="pb-5">Nueva Tarea</h1>
    <div class="container">
        <div class="row border rounded bg-light d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <form action="{{ isset($user) ? route('tasks.store', $user) : route('tasks.storeGroup', $group) }}"
                    method="POST" class="d-flex justify-content-center py-5">

                    @csrf

                    <div class="col-8">
                        <div class="d-flex justify-content-between pb-5">
                            <i class="fa-solid fa-user fa-4x text-primary"></i>
                            <i class="fa-solid fa-user-group fa-4x text-primary"></i>
                            <i class="fa-solid fa-list-check fa-4x text-primary"></i>
                        </div>
                        <div class="row form-group mt-3">
                            <div class="col">
                                <label for="start">Fecha de inicio de la tarea</label>
                                <input type="date" class="form-control" id="start" name="start"
                                    value="{{ old('start') }}">
                            </div>
                            @error('start')
                                <span style="color:red"> {{ $message }} </span>
                            @enderror
                            <div class="col">
                                <label for="end">Fecha de fin de la tarea</label>
                                <input type="date" class="form-control" aria-describedby="endInfo" id="end"
                                    name="end" value="{{ old('end') }}">
                            </div>
                            @error('end')
                                <span style="color:red"> {{ $message }} </span>
                            @enderror
                            <small id="endInfo" class="form-text text-muted">El campo fecha fin no es obligatorio</small>
                        </div>

                        <div class="form-group mt-3">
                            <label for="name">Nombre de la tarea</label>
                            <input type="name" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Introduzca su nombre">
                            @error('name')
                                <span style="color:red"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="description">Descripción de la tarea</label>
                            <textarea class="form-control text-align-start" id="description" name="description" placeholder="Describa su tarea">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <span style="color:red"> {{ $message }} </span>
                        @enderror
                        <div class="form-group mt-3">
                            <label for="group">Grupo: </label>
                            <select class="form-select" name="group" id="group" aria-describedby="groupInfo">
                                @isset($groups)
                                    <option value="">Selecciona un grupo si quieres una tarea grupal</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endisset
                            </select>
                            <small id="groupInfo" class="form-text text-muted">Para elegir una tarea grupal necesitas
                                pertenecer a un grupo, pídele al administrador que te asigne uno
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
