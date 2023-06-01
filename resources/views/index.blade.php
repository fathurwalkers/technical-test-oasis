@extends('layouts')

@section('main-content')

    <a href="{{ route('soal-one') }}">Soal 1</a>
    <br />

    <a href="{{ route('soal-two') }}">Soal 2</a>
    <br />

    <a href="{{ route('soal-three', ['sendok', 'doknes']) }}">Soal 3</a>
    <br />

    <a href="{{ route('soal-four', 1504023) }}">Soal 4</a>
    <br />

    <a href="{{ route('soal-five') }}">Soal 5</a>
    <br />

@endsection
