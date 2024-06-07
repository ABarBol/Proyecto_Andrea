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

        <h2 class="pb-3">Tareas asignadas</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Titulo de la tarea</h5>
                    <small class="text-muted">12/05/24 - 16/05/24</small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <form action="" method="POST">

                        @csrf

                        @method('delete')

                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
                <small>Administrador</small>
                <span class="badge bg-primary rounded-pill">Grupo</span>
            </li>
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Titulo de la tarea</h5>
                    <small class="text-muted">12/05/24 - 16/05/24</small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <form action="" method="POST">

                        @csrf

                        @method('delete')

                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
                <small>Administrador</small>
                <span class="badge bg-primary rounded-pill">Grupo</span>
            </li>
        </ul>
    </div>

    <div class="bg-light p-5 rounded">

        <h2 class="pb-3">Usuarios asignados</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h5 class="mb-1">Nombre del usuario</h5>

                    <small class="mb-1 text-muted">nombredeusuario@gmail.com</small>
                    <form action="" method="POST">

                        @csrf

                        @method('delete')
                        <a class="btn btn-primary">Ver usuario</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>

            </li>
        </ul>
    </div>
    <div class="bg-light p-5 rounded">

        <div class="d-flex justify-content-end pt-5">
            <form action="{{ route('users.destroy', $group) }}" method="POST">

                @csrf

                @method('delete')

                <button type="submit" class="btn btn-danger">Eliminar grupo</button>
            </form>
        </div>
    </div>

@endsection
