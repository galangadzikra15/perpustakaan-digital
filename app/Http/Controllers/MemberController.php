<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('nama', 'asc')->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        // VALIDASI (HAPUS no_telepon, email, alamat)
        $request->validate([
            'NIM' => 'required|string|max:15|unique:members,NIM',
            'nama' => 'required|string|max:100',
            'angkatan' => 'required|string|max:4',
            'jurusan' => 'required|string|max:50',
            'fakultas' => 'required|string|max:100'
        ]);

        try {
            Member::create([
                'NIM' => $request->NIM,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'jurusan' => $request->jurusan,
                'fakultas' => $request->fakultas
            ]);

            return redirect('/members')
                ->with('success', 'Anggota berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            return redirect('/members/create')
                ->with('error', 'Gagal menambahkan anggota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($NIM)
    {
        $member = Member::findOrFail($NIM);
        return view('members.show', compact('member'));
    }

    public function edit($NIM)
    {
        $member = Member::findOrFail($NIM);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $NIM)
    {
        $member = Member::findOrFail($NIM);

        $request->validate([
            'nama' => 'required|string|max:100',
            'angkatan' => 'required|string|max:4',
            'jurusan' => 'required|string|max:50',
            'fakultas' => 'required|string|max:100'
        ]);

        try {
            $member->update([
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'jurusan' => $request->jurusan,
                'fakultas' => $request->fakultas
            ]);
            
            return redirect('/members')
                ->with('success', 'Anggota berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect('/members/' . $NIM . '/edit')
                ->with('error', 'Gagal mengupdate anggota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($NIM)
    {
        $member = Member::findOrFail($NIM);

        if ($member->loans()->where('status', 'dipinjam')->count() > 0) {
            return redirect('/members')
                ->with('error', 'Anggota masih memiliki pinjaman aktif!');
        }

        try {
            $member->delete();
            return redirect('/members')
                ->with('success', 'Anggota berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/members')
                ->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }
}