@extends('layouts.global')

@section('title', 'Editar Usuario')

{{-- @section('content')
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
@endsection --}}

@section('content')
    <h1 class="pb-5">Editar perfil</h1>
    <div class="container">
        <div class="row border rounded bg-light">
            <div class="col-6">
                <form action="{{ route('users.update', $user) }}" method="POST" class="d-flex justify-content-center py-5">

                    @csrf

                    @method('put')

                    <div class="col-8">
                        <div class="d-flex justify-content-center pb-5">
                            <i class="fa-regular fa-id-card fa-4x text-primary"></i>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Nombre de usuario</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" placeholder="Introduzca su nombre de usuario">
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('name', $user->email) }}" aria-describedby="emailInfo"
                                placeholder="Introduzca su email">
                            <small id="emailInfo" class="form-text text-muted">No compartiremos tu email con nadie.</small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Introduzca su contraseña">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Editar</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <img class="img-fluid rounded-lg-3" src="https://ximg.es/700x700/000/fff" alt="">
            </div>
        </div>
    </div>


    @error('name')
        <br>
        <span style="color:red"> {{ $message }} </span>
    @enderror
    </form>
@endsection
