<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\LoansExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class FrontendLoanController extends Controller
{
    public function index()
    {
        return view('loans.index');
    }

    // ============================================
    // TAMBAHKAN METHOD CREATE & STORE
    // ============================================
    
    public function create()
    {
        // Ambil data buku dan anggota untuk dropdown
        $books = Book::all();
        $members = Member::all();
        
        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:books,id_buku',
            'NIM' => 'required|exists:members,NIM',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,dikembalikan,hilang,terlambat',
            'catatan' => 'nullable|string'
        ]);

        $loan = Loan::create([
            'id_buku' => $request->id_buku,
            'NIM' => $request->NIM,
            'id_user' => session('user_id'), // ID user yang login
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        return redirect('/loans')->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->bulan;
        
        if (empty($bulan)) {
            return back()->with('error', 'Silakan pilih bulan terlebih dahulu!');
        }

        return Excel::download(
            new LoansExport($bulan),
            'laporan-peminjaman-bulan-' . $bulan . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan;
        
        if (empty($bulan)) {
            return back()->with('error', 'Silakan pilih bulan terlebih dahulu!');
        }

        $loans = Loan::with(['book', 'member'])
            ->whereMonth('tanggal_pinjam', $bulan)
            ->get();

        $dipinjam = $loans->where('status', 'dipinjam')->count();
        $dikembalikan = $loans->where('status', 'dikembalikan')->count();
        $hilang = $loans->where('status', 'hilang')->count();
        $terlambat = $loans->where('status', 'terlambat')->count();

        $pdf = Pdf::loadView('loans.report', compact(
            'loans',
            'bulan',
            'dipinjam',
            'dikembalikan',
            'hilang',
            'terlambat'
        ));

        return $pdf->download('laporan-peminjaman-bulan-' . $bulan . '.pdf');
    }
}