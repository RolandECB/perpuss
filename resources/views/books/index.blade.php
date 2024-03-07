@extends('templates.default')

@php
    $preTitle = "List";
    $title = "Book";
@endphp

@section('page-action')
<div class="btn-list">
    <a href={{ route('books.create') }} class="btn btn-primary d-none d-sm-inline-block">
      <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
      Add books
    </a>
</div>
@endsection

@section('content')
<div class="col-md-5">
  <form action="{{ route('books.index') }}" method="GET">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search Keyword" aria-label="Cari" aria-describedby="basic-addon2" name="keyword" autocomplete="off" autofocus>
        <button class="btn btn-primary" type="submit" name="submit">Search</button>
    </div>
  </form>
</div>

<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>Author</th>
            <th>Title</th>
            <th>Cover</th>
            <th>Year</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($books as $book)
          <tr>
              <td>{{ $book->author->name }}</td>
              <td>{{ $book->title }}</td>
              <td>
                  <img src="{{ asset('storage/' . $book->cover) }}" height="150px" alt="{{ $book->title }}">
              </td> 
              <td>{{ $book->year }}</td>
              <td class="flex">
                  <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-primary mb-2">Edit</a>
                  &nbsp;&nbsp;
                  <form action="{{ route('books.destroy', $book->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="submit" class="btn btn-outline-danger mb-2" value="Delete">
                  </form>
                  <a href="{{ route('books.show', $book->id) }}"
                  class="btn btn-outline-warning">Details</a>
              </td>
          </tr>
          @endforeach          
        </tbody>
      </table>
    </div>
  </div>
@endsection