@extends('layouts.global')

@section('title', 'Grupo ' . $group->name)

@section('content')


    <div class="bg-light p-5 rounded">

        <h1> Grupo {{ $group->name }}</h1>

        <p class="lead">Si desea cambiar el nombre del grupo, complete el siguiente campo</p>
        <form action="{{ route('groups.update', $group) }}" method="POST">
            @csrf
            @method('put')
            <div class="row align-items-center">
                <div class="col-3">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nuevo nombre de grupo">
                    </div>
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-primary mb-2">Cambiar el nombre grupo</button>
                </div>
                @error('name')
                    <small style="color:red"> {{ $message }} </small>
                @enderror
            </div>
        </form>
    </div>

    <div class="bg-light p-5 rounded">

        <div class="row">
            <div class="col">
                <h2 class="pb-3">Tareas asignadas</h2>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('tasks.adminCreate', $group) }}" type="button" class="btn btn-success btn-lg"><i
                            class="fa-solid fa-plus"></i> Tarea</a>
                </div>
            </div>
        </div>
        <ul class="list-group">
            @forelse ($tasks as $task)
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $task->name }}</h5>
                        <small class="text-muted"> {{ $task->created_at }} </small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">{{ $task->description }}</p>
                        <form action="{{ route('groups.deleteTaskG', ['group' => $group, 'taskId' => $task->id]) }}"
                            method="POST">

                            @csrf

                            @method('delete')

                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                    <span class="badge text-bg-danger rounded-pill"><i class="fa-regular fa-calendar"></i>
                        Fecha</span>
                    <small> <i class="fa-solid fa-clock text-success "></i> {{ $task->start }} <i
                            class="fa-solid fa-arrow-right"></i> <i class="fa-regular fa-clock text-danger"></i>
                        {{ $task->end }}</small>

                </li>
            @empty
                <p>No hay tareas.</p>
            @endforelse
        </ul>
    </div>


    <div class="bg-light p-5 rounded">
        <h2 class="pb-3">Usuarios asignados</h2>
        <ul class="list-group">
            @forelse ($users as $user)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-1 flex-fill">{{ $user->name }}</h5>
                        <small class="mb-1 text-muted">{{ $user->email }}</small>
                        @if (Auth::user()->admin)
                            <div class="d-flex flex-row flex-wrap">
                                <div class="p-2">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Ver usuario</a>
                                </div>
                                <div class="p-2">
                                    <form
                                        action="{{ route('groups.deleteUser', ['user' => $user->id, 'groupId' => $group->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </li>
            @empty
                <p>No hay usuarios.</p>
            @endforelse
        </ul>
        @if (Auth::check() && Auth::user()->admin)
            <div class="col mt-3">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('groups.editUsers', $group) }}" type="button" class="btn btn-success btn-lg"><i
                            class="fa-solid fa-plus"></i> Usuario</a>
                </div>
            </div>
        @endif
    </div>
    <div class="bg-light p-5 rounded">

        <div class="d-flex justify-content-end pt-5">
            <form action="{{ route('groups.destroy', $group) }}" method="POST">

                @csrf

                @method('delete')

                <button type="submit" class="btn btn-danger">Eliminar grupo</button>
            </form>
        </div>
    </div>

@endsection
