<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan statistik
     */
    public function index()
    {
        // Menghitung total data
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        
        // Menghitung peminjaman aktif
        $activeLoans = Loan::where('status', 'dipinjam')->count();
        $lateReturns = Loan::where('status', 'terlambat')->count();
        
        // Mengambil 5 peminjaman terbaru
        $recentLoans = Loan::with(['book', 'member', 'user'])
                          ->orderBy('created_at', 'desc')
                          ->limit(5)
                          ->get();

        // Kirim data ke view
        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'activeLoans',
            'lateReturns',
            'recentLoans'
        ));
    }
}