@extends('layouts.global')

@section('title', 'Crear usuario')

@section('content')
    <h1 class="pb-5">Registro</h1>
    <div class="container">
        <div class="row border rounded bg-light">
            <div class="col-12 col-md-6">
                <img class="img-fluid rounded-lg-3" src="../img/register.svg" alt="">
            </div>
            <div class="col-12 col-md-6">
                <form action="{{ route('register') }}" method="POST" class="d-flex justify-content-center py-5">

                    @csrf

                    <div class="col-8">
                        <div class="d-flex justify-content-center pb-5">
                            <i class="fa-regular fa-id-card fa-4x text-primary"></i>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Nombre de usuario</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Introduzca su nombre de usuario">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" aria-describedby="emailInfo" placeholder="Introduzca su email">
                            <small id="emailInfo" class="form-text text-muted">No compartiremos tu email con nadie.</small>
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

                        <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
@endsection
