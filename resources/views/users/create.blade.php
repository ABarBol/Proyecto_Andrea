@extends('layouts.global')

@section('title', 'Crear usuario')

@section('content')
    <h1 class="pb-5">Registro</h1>
    <div class="container">
        <div class="row border rounded bg-light">
            <div class="col-6">
                <img class="img-fluid rounded-lg-3" src="https://ximg.es/700x700/000/fff" alt="">
            </div>
            <div class="col-6">
                <form action="{{ route('users.store') }}" method="POST" class="d-flex justify-content-center py-5">

                    @csrf

                    <div class="col-8">
                        <div class="d-flex justify-content-center pb-5">
                            <i class="fa-regular fa-id-card fa-4x text-primary"></i>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Nombre de usuario</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Introduzca su nombre de usuario">
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" aria-describedby="emailInfo" placeholder="Introduzca su email">
                            <small id="emailInfo" class="form-text text-muted">No compartiremos tu email con nadie.</small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Introduzca su contraseña">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @error('name')
        <br>
        <span style="color:red"> {{ $message }} </span>
    @enderror
    </form>
@endsection
