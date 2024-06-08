@extends('layouts.global')

@section('title', 'Calendario')

@section('headContent')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<div id="app"><CalendarComponent :events="{{ json_encode($events) }}"></CalendarComponent></div>
@endsection