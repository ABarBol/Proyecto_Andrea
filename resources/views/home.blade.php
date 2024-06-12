@extends('layouts.global')

@section('title', 'Página principal')

@section('content')
<div class="container">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1">Organiza tu tiempo.</h1>
        <p class="lead">Gestiona tus tareas y proyectos grupales en un solo lugar. Nuestra aplicación te permite crear, compartir y seguir tus actividades con facilidad.</p>
        @guest
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
          <a href="{{route('login')}}" type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Log in</a>
          <a href="{{route('register')}}"  type="button" class="btn btn-outline-dark btn-lg px-4">Registrarse</a>
        </div>
        @endguest
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden">
          <img class="img-fluid rounded-lg-3" src="../img/home.png" alt="">
      </div>
    </div>
  </div>
<div class="row">
    <div class="container px-4 py-5" id="featured-3">
        <div class="pb-2 border-bottom"></div>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
          <div class="col">
            <i class="fa-solid fa-calendar-check fa-3x text-primary mb-3"></i>
            <h2>Gestiona tus tareas</h2>
            <p>Crea tareas individuales o grupales y visualízalas en un calendario interactivo.</p>
          </div>
          <div class="col">
            <i class="fa-solid fa-hand-point-up fa-3x text-primary mb-3"></i>
            <h2>Tú decides</h2>
            <p>Las tareas grupales están disponibles para todos los miembros del grupo, pero puedes borrarlas de tu perfil.</p>
          </div>
          <div class="col">
            <i class="fa-solid fa-hammer fa-3x text-primary mb-3"></i>
            <h2>Administración sencilla</h2>
            <p>La interfaz de administrador es sencilla e intuitiva para poder gestionarla con facilidad.</p>
          </div>
        </div>
      </div>
</div>
@endsection
