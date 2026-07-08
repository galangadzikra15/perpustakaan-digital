<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIM' => 'required|unique:members,NIM',
            'nama' => 'required',
            'angkatan' => 'required',
            'jurusan' => 'required',
            'fakultas' => 'required'
        ]);

        Member::create($request->all());
        return redirect('/members')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($NIM)
    {
        $member = Member::findOrFail($NIM);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $NIM)
    {
        $member = Member::findOrFail($NIM);
        $member->update($request->all());
        return redirect('/members')->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy($NIM)
    {
        $member = Member::findOrFail($NIM);
        $member->delete();
        return redirect('/members')->with('success', 'Anggota berhasil dihapus');
    }
}