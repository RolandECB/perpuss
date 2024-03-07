@extends('templates.default')

@php
    $preTitle = "Detail";
    $title = "Book";
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <img src="{{ asset('storage/' . $book->cover) }}" style="max-height: 500px;" class="img-fluid mb-3" alt="{{ $book->title }}">
        <h5 class="card-title">{{ $book->title }}</h5>
        <p class="card-text">Year: {{ $book->year }}</p>
        <p class="card-text">Author: {{ $book->author->name }}</p>
    </div>
</div>
@endsection
