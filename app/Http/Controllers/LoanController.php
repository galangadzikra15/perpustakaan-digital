<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'member', 'user'])
                     ->orderBy('created_at', 'desc')
                     ->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::all();
        $members = Member::all();
        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:books,id_buku',
            'NIM' => 'required|exists:members,NIM',
            'tanggal_pinjam' => 'required|date'
        ]);

        $data = $request->all();
        $data['id_user'] = session('user_id');
        $data['status'] = 'dipinjam';

        Loan::create($data);

        return redirect('/loans')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function show($id)
    {
        $loan = Loan::with(['book', 'member', 'user'])->findOrFail($id);
        return view('loans.show', compact('loan'));
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $books = Book::all();
        $members = Member::all();
        return view('loans.edit', compact('loan', 'books', 'members'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update($request->all());

        return redirect('/loans')->with('success', 'Peminjaman berhasil diupdate!');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect('/loans')->with('success', 'Peminjaman berhasil dihapus!');
    }

    // Method untuk mengembalikan buku
    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);
        
        if ($loan->status == 'dikembalikan') {
            return redirect('/loans')->with('error', 'Buku sudah dikembalikan!');
        }

        $loan->status = 'dikembalikan';
        $loan->tanggal_kembali = now();
        $loan->save();

        return redirect('/loans')->with('success', 'Buku berhasil dikembalikan!');
    }
}