@extends('layouts.global')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3">
      <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
        <h1 class="display-4 fw-bold lh-1">Border hero with cropped image and shadows</h1>
        <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        @guest
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
          <a href="{{route('login')}}" type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Log in</a>
          <a href="{{route('register')}}"  type="button" class="btn btn-outline-secondary btn-lg px-4">Registrarse</a>
        </div>
        @endguest
      </div>
      <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden">
          <img class="img-fluid rounded-lg-3" src="https://ximg.es/700x700/000/fff" alt="">
      </div>
    </div>
  </div>
<div class="row">
    <div class="container px-4 py-5" id="featured-3">
        <div class="pb-2 border-bottom"></div>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
          <div class="col">
            <i class="fa-solid fa-user-group fa-2x text-primary m-2"></i>
            <h2>Featured title</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          </div>
          <div class="col">
            <i class="fa-solid fa-user-group fa-2x text-primary m-2"></i>
            <h2>Featured title</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          </div>
          <div class="col">
            <i class="fa-solid fa-user-group fa-2x text-primary m-2"></i>
            <h2>Featured title</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          </div>
        </div>
      </div>
</div>
@endsection
