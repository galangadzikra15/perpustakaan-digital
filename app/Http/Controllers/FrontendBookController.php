<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Imports\BooksImport;
use Maatwebsite\Excel\Facades\Excel;

class FrontendBookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'sinopsis' => $request->sinopsis
        ]);

        return redirect('/books')
            ->with('success', 'Data buku berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'sinopsis' => $request->sinopsis
        ]);

        return redirect('/books')
            ->with('success', 'Data buku berhasil diupdate');
    }

    // Hapus buku
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect('/books')
            ->with('success', 'Data buku berhasil dihapus');
    }
    public function import(Request $request)
{
    // Validasi file
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:2048'
    ]);

    // Proses import
    Excel::import(new BooksImport, $request->file('file'));

    // Redirect dengan pesan sukses
    return redirect('/books')->with('success', 'Data buku berhasil diimport!');
}
}