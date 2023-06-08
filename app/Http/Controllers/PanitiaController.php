<?php

namespace App\Http\Controllers;

use App\Models\Panitia;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("panitia.index")->with([
            "data" => Panitia::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => "required",
            "nomor_telefon" => "required",
            "email" => "required",
            "alamat" => "required",
        ]);

        $pros = Panitia::create([
            "nama" => $request->nama,
            "nomor_telepon" => $request->nomor_telefon,
            "email" => $request->email,
            "alamat" => $request->alamat,
        ]);

        $KeyflashMassage = $pros == true ? "ok" : "no";
        $massageFlshMassage =
            $pros == true ? "Data Berhasil Disimpan" : "Data Gagal Disimpan";

        return redirect()
            ->route("panitia.index")
            ->with([$KeyflashMassage => $massageFlshMassage]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function show(Panitia $panitia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function edit(Panitia $panitia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Panitia $panitia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Panitia  $panitia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Panitia $panitia)
    {
        //
    }
}
