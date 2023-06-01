<?php

namespace App\Http\Controllers;

// Load Model
use App\Models\Peserta;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $dataPeserta = Peserta::latest()->paginate(5);

        return view("peserta.index", compact("dataPeserta"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => "required|min:10",
            "nomor_telefon" => "required|min:8|numeric",
            "alamat" => "required|min:10",
        ]);

        $pros = Peserta::create([
            "nama" => $request->nama,
            "nomor_telefon" => $request->nomor_telefon,
            "alamat" => $request->alamat,
        ]);

        return redirect()
            ->route("peserta.index")
            ->with(["success" => "Data Berhasil Disimpan.!"]);
    }
}
