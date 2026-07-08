<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoansExport implements FromCollection, WithHeadings
{
    protected string $bulan;

    public function __construct(string $bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Loan::with(['book', 'member'])
            ->whereMonth('tanggal_pinjam', $this->bulan)
            ->get()
            ->map(function ($loan) {
                return [
                    'ID' => $loan->id_peminjaman,
                    'Judul Buku' => $loan->book->judul ?? '-',
                    'Nama Anggota' => $loan->member->nama ?? '-',
                    'Tanggal Pinjam' => $loan->tanggal_pinjam,
                    'Tanggal Kembali' => $loan->tanggal_kembali ?? '-',
                    'Status' => $loan->status,
                    'Catatan' => $loan->catatan ?? '-'
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Peminjaman',
            'Judul Buku',
            'Nama Anggota',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Catatan'
        ];
    }
}