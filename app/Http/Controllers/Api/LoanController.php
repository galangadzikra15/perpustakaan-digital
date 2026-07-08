<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return response()->json(

            Loan::with([
                'book',
                'member',
                'user'
            ])->get()

        );
    }

    public function store(Request $request)
    {
        return response()->json(
            Loan::create($request->all()),
            201
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Loan::with([
                'book',
                'member',
                'user'
            ])->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $loan->update(
            $request->all()
        );

        return response()->json([
            'message'=>'Data berhasil diupdate'
        ]);
    }

    public function destroy(string $id)
    {
        Loan::findOrFail($id)
            ->delete();

        return response()->json([
            'message'=>'Data berhasil dihapus'
        ]);
    }
}