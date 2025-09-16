<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of publishers.
     */
    public function index()
    {
        $publishers = Publisher::withCount('books')->paginate(10);
        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new publisher.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Store a newly created publisher in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:publishers,nama',
        ]);

        Publisher::create($request->only('nama'));

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Penerbit berhasil ditambahkan.');
    }

    /**
     * Display the specified publisher.
     */
    public function show(Publisher $publisher)
    {
        $publisher->load('books');
        return view('admin.publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified publisher.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified publisher in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:publishers,nama,' . $publisher->id,
        ]);

        $publisher->update($request->only('nama'));

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Penerbit berhasil diperbarui.');
    }

    /**
     * Remove the specified publisher from storage.
     */
    public function destroy(Publisher $publisher)
    {
        // Check if publisher has books
        if ($publisher->books()->count() > 0) {
            return redirect()->route('admin.publishers.index')
                ->with('error', 'Tidak dapat menghapus penerbit yang memiliki buku.');
        }

        $publisher->delete();

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Penerbit berhasil dihapus.');
    }
}
