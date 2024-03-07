@extends('templates.default')

@php
    $title = 'Data Siswa';
    $preTitle = 'Edit Data Siswa';
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" class="" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
        
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan judul buku" value="{{ old('title') ?? $book->title }}">
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <select name="author_id" class="form-select">
                        <option value="" selected disabled>Pilih Penulis</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" placeholder="Pilih gambar cover">
                    @error('cover')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" placeholder="Masukkan tahun terbit" value="{{ old('year') ?? $book->year }}">
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