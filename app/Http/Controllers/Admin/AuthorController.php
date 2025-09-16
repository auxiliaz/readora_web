<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors.
     */
    public function index()
    {
        $authors = Author::withCount('books')->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:authors,nama',
        ]);

        Author::create($request->only('nama'));

        return redirect()->route('admin.authors.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    /**
     * Display the specified author.
     */
    public function show(Author $author)
    {
        $author->load('books');
        return view('admin.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified author.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified author in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:authors,nama,' . $author->id,
        ]);

        $author->update($request->only('nama'));

        return redirect()->route('admin.authors.index')
            ->with('success', 'Penulis berhasil diperbarui.');
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author)
    {
        // Check if author has books
        if ($author->books()->count() > 0) {
            return redirect()->route('admin.authors.index')
                ->with('error', 'Tidak dapat menghapus penulis yang memiliki buku.');
        }

        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Penulis berhasil dihapus.');
    }
}
