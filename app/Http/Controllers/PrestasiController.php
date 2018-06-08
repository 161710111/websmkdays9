<?php

namespace App\Http\Controllers;

use App\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestasis = Prestasi::all();
        return view ('prestasi.index',compact('prestasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestasi.create');
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
            'perolehan' => 'required|'
        ]);
        $prestasis = new Prestasi;
        $prestasis->nama = $request->nama;
        $prestasis->perolehan = $request->perolehan;
        $prestasis->save();
        return redirect()->route('prestasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestasis = Prestasi::findOrFail($id);
        return view('prestasi.show',compact('prestasis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestasis = Prestasi::findOrFail($id);
        return view('prestasi.edit',compact('prestasis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nama' => 'required|',
            'perolehan' => 'required|'
        ]);
        $prestasis = Prestasi::findOrFail($id);
        $prestasis->nama = $request->nama;
        $prestasis->perolehan = $request->perolehan;
        $prestasis->save();
        return redirect()->route('prestasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestasis = Prestasi::findOrFail($id);
         $prestasis->delete();
        return redirect()->route('prestasi.index');
    }
}
