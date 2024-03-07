<?php

namespace App\Http\Controllers;
use App\Models\author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class authorsController extends Controller
{
    public function index()
    {
        return view ('authors.index', [
            'authors' => author::get(),
        ]);
    }

    public function create()
    {
        return view ('authors.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required',
            'photo' =>'required',
        ]);

        Author::create([
            'name' => $request->name,
            'photo' => $request->file('photo')->store('photos/author_photo', 'public'),
        ]);

        session()->flash('success', 'Data Berhasil Dibuat');

        return redirect() -> route('authors.index');
    }

    public function edit($id)
    {
        
        $author = author::find($id);

        return view('authors.edit', [
            'author'=> $author,
        ]);
    }

    public function update(request $request, $id)
    {

        $this->validate($request, [
            'name' =>'required',
            'photo' =>'required',
        ]);

        $author = Author::find($id);
        $author->name = $request->name;
        $author->photo = $request->file('photo')->store('photos/author_photo', 'public');
        $author->save();

        session()->flash('info', 'Data Berhasil Diperbarui');

        return redirect() -> route('authors.index');
    }

    public function destroy($id) {
        $author = Author::findOrFail($id);
        
        // Delete related books first
        $author->books()->delete();
        
        // Delete author's photo
        if (Storage::exists('public/' . $author->photo)) {
            Storage::delete('public/' . $author->photo);
        }
    
        // Now delete the author
        $author->delete();
    
        session()->flash('danger', 'Data Berhasil Dihapus');
    
        return redirect()->route('authors.index');
    }
}    
