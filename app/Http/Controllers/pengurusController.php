<?php

namespace App\Http\Controllers;

use App\Models\pengurus;
use Illuminate\Http\Request;

class pengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)) {
            $data = pengurus::where('nis','like',"%$katakunci%")
            ->orwhere('nama','like',"%$katakunci%")
            ->orwhere('jurusan','like',"%$katakunci%")
            ->paginate($jumlahbaris);
        }else{
            $data = pengurus::orderBy('nis','desc')->paginate($jumlahbaris);
        }

        return view('pengurus.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengurus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Session::flash('nis',$request->nis);
        // Session::flash('nama',$request->nama);
        // Session::flash('jurusan',$request->jurusan);

        $request->validate([
            'nis' => 'required|numeric|unique:pengurus,nis',
            'nama' => 'required',
            'jurusan' => 'required',
        ],[
            'nis.required'=>'NIS wajib diisi',
            'nis.numeric'=>'NIS wajib dalam angka',
            'nis.unique'=>'NIS yang diisikan sudah ada dalam database',
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'Jurusan wajib diisi',
        ]);

        $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jurusan' => $request->jurusan,
        ];
        pengurus::create($data);
        return redirect()->to('pengurus')->with('success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = pengurus::where('nis',$id)->first();

        return view('pengurus.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'Jurusan wajib diisi',
        ]);

        $data = [

            // 'nis' => $request->nis,
                'nama'=>$request->nama,
                'jurusan'=>$request->jurusan,
        ];

        pengurus::where('nis', $id)->update($data);

        //  return dd($data);
        return redirect()->to('pengurus')->with('success','Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        pengurus::where('nis',$id)->delete();
        return redirect()->to('pengurus')->with('success','Data berhasil dihapus');
    }
}
