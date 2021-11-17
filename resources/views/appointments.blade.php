<?php
@extends('layout')

@section('content')
    @foreach($appointment as $appointments)
        <article>
        <h1>
            <a href="/appointments/{{$appointment > id}}}">
                {{$appointment > starts_at}}
            </a>
        </h1>
            <div>
                {{$appointment > excerpt}}
            </div>
        </article>
    @endforeach
@endsection
