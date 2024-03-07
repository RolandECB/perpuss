@extends('templates.default')

@php
    $title = 'Data Author';
    $preTitle = 'Tambah Data';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('authors.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tulis namamu" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Foto</label>
                    <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" placeholder="Foto">
                    @error('photo')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
