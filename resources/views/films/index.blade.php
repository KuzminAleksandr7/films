@extends('layouts.app')

@section('content')
    @foreach($films as $film)
        <div>{{ $film->title }}</div>
    @endforeach
@endsection
