@extends('templates.default')

@php
    $title = 'Tambah Data Buku';
    $preTitle = 'Tambah Data';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.store') }}" class="" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title"
                        class="form-control
                        @error('title')
                            is-invalid
                        @enderror"
                        placeholder="Masukkan judul buku" value="{{ old('title') }}">
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <select name="author_id" class="form-select">
                        <option value="" selected disabled>Pilih Penulis</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror"
                        placeholder="Pilih gambar cover" value="{{ old('cover') }}">
                    @error('cover')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" name="year"
                        class="form-control @error('year')
                            is-invalid
                        @enderror"
                        placeholder="Masukkan tahun terbit" value="{{ old('year') }}">
                    @error('year')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
