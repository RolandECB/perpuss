<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $books = Book::with('author')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('year', 'like', '%' . $keyword . '%')
                    ->orWhereHas('author', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->get();
    
        return view('books.index', ['books' => $books]);
    }
    

    // Method lainnya...

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Lakukan pencarian berdasarkan judul, tahun, dan penulis
        $books = Book::with('author')
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('year', 'like', '%' . $search . '%')
            ->orWhereHas('author', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();
    
        return view('books.index', ['books' => $books]);    
    }

    public function create()
    {
        $authors = Author::all(); // Mendapatkan semua data penulis
        return view('books.create', ['authors' => $authors]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required',
            'author_id' =>'required',
            'year' =>'required',
        ]);

        Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'year' => $request->year,
            'cover' => $request->file('cover')->store('photos/book_cover', 'public'),
        ]);

        session()->flash('success', 'Data Berhasil Ditambahkan');

        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id); // Menggunakan findOrFail untuk menemukan buku atau menampilkan 404 jika tidak ditemukan
        $authors = Author::all(); // Mendapatkan semua data penulis
        return view('books.edit', ['book' => $book, 'authors' => $authors]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $this->validate($request, [
            'title' => 'required',
            'year' => 'required',
            'author_id' => 'required',
        ]);
    
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->year = $request->year;
    
        // Cek apakah ada file yang diunggah
        if ($request->hasFile('cover')) {
            // Hapus gambar lama jika ada
            if (Storage::exists('public/' . $book->cover)) {
                Storage::delete('public/' . $book->cover);
            }
            // Simpan gambar baru
            $book->cover = $request->file('cover')->store('photos/book_cover', 'public');
        }
    
        // Simpan perubahan pada buku
        $book->save();
    
        // Flash session dan redirect ke halaman index
        session()->flash('info', 'Data Berhasil Diperbarui');
        return redirect()->route('books.index');
    }
    

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if (Storage::exists('public/' . $book->cover)) {
            Storage::delete('public/' . $book->cover);
        }
        $book->delete();

        session()->flash('danger', 'Data Berhasil Dihapus');
        
        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id)->load('author', 'publisher');
        return view('books.show', compact('book'));
    }


}
