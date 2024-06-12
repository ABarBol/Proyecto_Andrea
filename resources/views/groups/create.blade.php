@extends('layouts.global')

@section('title', 'Crear usuario')

@section('headContent')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <h1 class="pb-5">Nuevo grupo</h1>
    <div class="container">
        <div class="row border rounded bg-light d-flex justify-content-center py-5">
            <div class="col-12">
                <form action="{{ route('groups.store') }}" method="POST" class="d-flex justify-content-center py-5">

                    @csrf

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="d-flex justify-content-center pb-5">
                            <i class="fa-solid fa-people-group fa-4x text-primary"></i>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Nombre de grupo</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Introduzca el nombre del grupo">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="users">Usuarios del grupo</label>
                            <select class="form-select js-example-basic-multiple" id="users" name="users[]" multiple="multiple">
                                <option value=""></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ in_array($user->id, old('users', [])) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('users')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Crear grupo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
