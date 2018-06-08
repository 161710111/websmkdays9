<?php

namespace App\Http\Controllers;

use App\Programstudi;
use App\Fasilitas;
use App\Industri;
use Illuminate\Http\Request;

class ProgramstudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programstudis = Programstudi::with('Fasilitas')->get();
        $programstudis = Programstudi::with('Industri')->get();
        return view('programstudi.index',compact('programstudis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        $industris = Industri::all();
         return view('programstudi.create',compact('fasilitas','industris'));
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
            'industri_id' => 'required'
        ]);
        $programstudis = new Programstudi;
        $programstudis->nama = $request->nama;
        $programstudis->keterangan = $request->keterangan;
        $programstudis->fasilitas_id = $request->fasilitas_id;
        $programstudis->industri_id = $request->industri_id;
        $programstudis->save();
        return redirect()->route('programstudi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programstudi  $programstudi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programstudis = Programstudi::findOrFail($id);
        return view('programstudi.show',compact('programstudis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programstudi  $programstudi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programstudis = Programstudi::findOrFail($id);
         $fasilitas = Fasilitas::all();
         $selectedFasilitas = Programstudi::findOrFail($id)->fasilitas_id;
         $industris = Industri::all();
         $selectedIndustri = Programstudi::findOrFail($id)->industri_id;
        return view('programstudi.edit',compact('programstudis','fasilitas','selectedFasilitas','industris','selectedIndustri')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programstudi  $programstudi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|',
            'keterangan' => 'required|',
            'fasilitas_id' => 'required',
            'industri_id' => 'required'
        ]);
        $programstudis = Programstudi::findOrFail($id);
        $programstudis->nama = $request->nama;
        $programstudis->keterangan = $request->keterangan;
        $programstudis->fasilitas_id = $request->fasilitas_id;
        $programstudis->industri_id = $request->industri_id;
        $programstudis->save();
        return redirect()->route('programstudi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programstudi  $programstudi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programstudis = Programstudi::findOrFail($id);
        $programstudis->delete();
        return redirect()->route('programstudi.index');
    }
}
