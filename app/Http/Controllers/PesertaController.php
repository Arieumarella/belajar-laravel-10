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
            ->with(["ok" => "Data Berhasil Disimpan.!"]);
    }

    public function edit($id = null)
    {
        $data = Peserta::find($id);

        return response()->json([
            "success" => true,
            "data" => $data,
        ]);
    }

    public function update($request, $id)
    {
        $this->validate($request, [
            "nama" => "required|min:10",
            "nomor_telefon" => "required|min:8|numeric",
            "alamat" => "required|min:10",
        ]);

        $peserta = Peserta::findOrFail($id);

        $peserta->update([
            "nama" => $request->nama,
            "nomor_telefon" => $request->nomor_telefon,
            "alamat" => $request->alamat,
        ]);

        return redirect()
            ->route("peserta.index")
            ->with(["ok" => "Data Berhasil Disimpan.!"]);
    }

    public function show(Peserta $Peserta)
    {
        //return response
        return response()->json([
            "success" => true,
            "message" => "Detail Data Post",
            "data" => $Peserta,
        ]);
    }

    public function destroy($id)
    {
        $pros = Peserta::where("id", $id)->delete();

        if ($pros == true) {
            session()->flash("ok", "Data berhasil dihapus.");
        } else {
            session()->flash("no", "Data gagal dihapus.");
        }

        return response()->json([
            "success" => true,
            "message" => "Data Post Berhasil Dihapus!.",
        ]);
    }
}
