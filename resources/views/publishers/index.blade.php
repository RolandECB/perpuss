@extends('templates.default')

@php
    $title = 'Data Publisher';
    $preTitle = 'Semua Data';
@endphp

@section('page-action')
<div class="btn-list">
    <a href={{ route('publishers.create') }} class="btn btn-primary d-none d-sm-inline-block">
      <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
      Add publishers
    </a>
</div>
@endsection

@section('content')
<div class="card">
    <div class="table-responsive">
      <table class="table table-vcenter card-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th class="w-1"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($publishers as $publisher)
          <tr>
            <td>{{ $publisher->name }}</td>
            <td>{{ $publisher->address }}</td>
              <td class="flex">
                  <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-outline-primary mb-2">Edit</a>
                  &nbsp;&nbsp;
                  <form action="{{ route('publishers.destroy', $publisher->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="submit" class="btn btn-outline-danger mb-2" value="Delete">
                  </form>
              </td>
          </tr>
          @endforeach          
        </tbody>
      </table>
    </div>
  </div>
@endsection
