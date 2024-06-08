@extends('layouts.global')

@section('title', 'Usuarios ')

@section('content')
    @if (Auth::user()->admin)
    <h1>Administrar usuarios</h1>
    @else
    <h1>Lista de usuarios</h1>
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


@endsection
