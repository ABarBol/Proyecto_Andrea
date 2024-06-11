@extends('layouts.global')

@section('title', 'Login')

@section('content')
    <h1 class="pb-5">Log in</h1>
    <div class="container">
        <div class="row border rounded bg-light">
            <div class="col-12 col-md-6">
                <img class="img-fluid rounded-lg-3" src="../img/login.svg" alt="">
            </div>
            <div class="col-12 col-md-6">
                <form action="{{ route('login') }}" method="POST" class="d-flex justify-content-center py-5">

                    @csrf

                    <div class="col-8">
                        <div class="d-flex justify-content-center pb-5">
                            <i class="fa-regular fa-id-card fa-4x text-primary"></i>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" aria-describedby="emailInfo" placeholder="Introduzca su email">
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group mt-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Introduzca su contraseña">
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        <button type="submit" class="btn btn-primary mt-3">Iniciar sesión</button>
                        @error('login_error')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>
@endsection
