@extends('layouts.global')

@section('title', 'Usuarios ')

@section('headContent')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
    @if (Auth::user()->admin)
        <h1>Administrar usuarios</h1>
    @else
        <h1>Lista de usuarios</h1>
    @endif

    @if (Auth::user()->admin)
        <form action="{{ route('users.search', Auth::user()) }}" method="post">

            @csrf
            <div class="form-group">
                <label for="search">Buscar usuario:</label>
                <select class="form-select js-example-basic-single" name="user_id">
                    <option value=""></option>
                    @foreach ($allUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mt-2">Buscar</button>
            </div>
        </form>
    @endif

    <div class="my-3 p-3 bg-white rounded box-shadow">
        @foreach ($users as $user)
            <div class="media text-muted pt-3">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <strong class="text-gray-dark">{{ $user->name }}</strong>
                        @if (Auth::user()->admin)
                            <a href="{{ route('users.show', $user->id) }}"><i class="fa-solid fa-circle-user fa-3x"></i></a>
                        @endif
                    </div>
                    <span class="d-block">{{ $user->email }}</span>
                </div>
            </div>
        @endforeach

        <small class="d-block text-right mt-3">
            {{ $users->links() }}
        </small>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
