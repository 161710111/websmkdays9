<?php

namespace App\Http\Controllers;

use App\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $industris = Industri::all();
        return view ('industri.index',compact('industris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('industri.create');
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
            'logo' => 'required|',
            'nama' => 'required|',
            'deskripsi' => 'required|'
        ]);
        $industris = new Industri;
        $industris->nama = $request->nama;
        $industris->deskripsi = $request->deskripsi;
      
         //apload foto
        if ($request->hasFile('logo')){
            $file=$request->file('logo');
            $destinationPath=public_path().'/assets/admin/images/icon/';
            $filename=str_random(6).'_'.$file->getClientOriginalName();
            $uploadSucces= $file->move($destinationPath,$filename);
            $industris->logo= $filename;
        }

        $industris->save();
        return redirect()->route('industri.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Industri  $industri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industris = Industri::findOrFail($id);
        return view('industri.show',compact('industris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Industri  $industri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $industris = Industri::findOrFail($id);
        return view('industri.edit',compact('industris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Industri  $industri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'nama' => 'required|',
            'deskripsi' => 'required|'
        ]);
        $industris = Industri::findOrFail($id);
        $industris->logo = $request->logo;
        $industris->nama = $request->nama;
        $industris->deskripsi = $request->deskripsi;


        if ($request->hasFile('logo')) {
            $uploaded_logo = $request->file('logo');
            $extension = $uploaded_logo->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . '/assets/admin/images/icon/';
            $uploaded_logo->move($destinationPath, $filename);
        // if ($request->hasFile('logo')){
        //     $file=$request->file('logo');
        //     $destinationPath=public_path().'/assets/admin/images/icon/';
        //     $filename=str_random(6).'_'.$file->getClientOriginalName();
        //     $uploadSucces=$file->move($destinationPath,$filename);
        //     $industris->logo=$filename;

        //     if ($industris->logo){
        //         $old_foto=$industris->logo;
        //         $filepath=public_path().DIRECTORY_SEPARATOR.'/assets/admin/images/icon/'.DIRECTORY_SEPARATOR . $industris->logo;
        //         try{
        //             File::delete($filepath);
        //         }catch (FileNotFoundException $e){
        //             //file sudah dihapus/tidak ada
        //         }
        //     }
            $industris->logo=$filename;
        $industris->save();
    }
        return redirect()->route('industri.index');
    }

    //           $this->validate($request, [
    //         'foto' => 'image|max:20048',
    //         'id_mobil' => 'required'
    //     ]);
    //     $galeri = Galeri::find($id);
    //     $galeri -> update($request->all());
    //     // isi field foto jika ada foto yang diupload
    //     if ($request->hasFile('foto')) {
    //     // Mengambil file yang diupload
    //     $uploaded_foto = $request->file('foto');
    //     // mengambil extension file
    //     $extension = $uploaded_foto->getClientOriginalExtension();
    //     // membuat nama file random berikut extension
    //     $filename = md5(time()) . '.' . $extension;
    //     // menyimpan foto ke folder public\img\galeri
    //     $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img\galeri';
    //     $uploaded_foto->move($destinationPath, $filename);
    //     // mengisi field foto di galeri dengan filename yang baru dibuat
    //     $galeri->foto = $filename;
    //     $galeri->save();
    //     }
        
    //     return redirect()->route('galeri.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Industri  $industri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $industris = Industri::findOrFail($id);
         $industris->delete();
        return redirect()->route('industri.index');
    }
}

// if ($industris->logo){
            //     $old_foto=$industris->logo;
            //     $filepath=public_path().DIRECTORY_SEPARATOR.'/assets/img/fotoindustri.DIRECTORY_SEPARATOR.$industris->logo';
            //     try{
            //         File::delete($filepath);
            //     }catch (FileNotFoundException $e){
            //         //file sudah dihapus/tidak ada
            //     }
            // }
            // $industris->logo=$filename;