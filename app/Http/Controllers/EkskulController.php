<?php

namespace App\Http\Controllers;

use App\Ekskul;
use App\Fasilitas;
use App\Prestasi;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekskuls = Ekskul::with('Fasilitas')->get();
        $ekskuls = Ekskul::with('Prestasi')->get();
        return view('ekskul.index',compact('ekskuls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        $prestasis = Prestasi::all();
         return view('ekskul.create',compact('fasilitas','prestasis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|',
            'keterangan' => 'required|',
            'fasilitas_id' => 'required',
            'prestasi_id' => 'required'
        ]);
        $ekskuls = new Ekskul;
        $ekskuls->nama = $request->nama;
        $ekskuls->keterangan = $request->keterangan;
        $ekskuls->fasilitas_id = $request->fasilitas_id;
        $ekskuls->prestasi_id = $request->prestasi_id;
        $ekskuls->save();
        return redirect()->route('ekskul.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ekskuls = Ekskul::findOrFail($id);
        return view('ekskul.show',compact('ekskuls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ekskuls = Ekskul::findOrFail($id);
         $fasilitas = Fasilitas::all();
         $selectedFasilitas = Ekskul::findOrFail($id)->fasilitas_id;
         $prestasis = Prestasi::all();
         $selectedGuru = Ekskul::findOrFail($id)->prestasi_id;
        return view('ekskul.edit',compact('ekskuls','prestasis','selectedPrestasi','fasilitas','selectedFasilitas')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|',
            'fasilitas_id' => 'required',
            'prestasi_id' => 'required|',
            'keterangan' => 'required'
        ]);
        $ekskuls = Ekskul::findOrFail($id);
        $ekskuls->nama = $request->nama;
        $ekskuls->keterangan = $request->keterangan;
        $ekskuls->fasilitas_id = $request->fasilitas_id;
        $ekskuls->prestasi_id = $request->prestasi_id;
        $ekskuls->save();
        return redirect()->route('ekskul.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ekskul  $ekskul
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ekskuls = Ekskul::findOrFail($id);
        $ekskuls->delete();
        return redirect()->route('ekskul.index');
    }
}
