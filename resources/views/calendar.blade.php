@extends('layouts.global')

@section('title', 'Home')

@section('content')
<div id="app"><CalendarComponent :events="{{ json_encode($events) }}"></CalendarComponent></div>
@endsection