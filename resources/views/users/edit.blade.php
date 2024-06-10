@extends('layouts.global')

@section('title', 'Editar Usuario')

@section('content')
    <h1 class="pb-5">Editar perfil</h1>
    <div class="container">
        <div class="row border rounded bg-light">
            <div class="col-12 col-md-6">
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
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" aria-describedby="emailInfo"
                                placeholder="Introduzca su email">
                            @error('email')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Introduzca su contraseña">
                            @error('password')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Editar</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <img class="img-fluid rounded-lg-3" src="https://ximg.es/700x700/000/fff" alt="">
            </div>
        </div>
    </div>
    </form>
@endsection
