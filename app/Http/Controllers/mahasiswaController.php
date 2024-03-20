<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = mahasiswa::orderBy('nim','desc')->paginate(2);
        return view('mahasiswa.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim',$request->nim);
        Session::flash('nama',$request->nama);
        Session::flash('alamat',$request->alamat);
        Session::flash('hobi',$request->hobi);

        $request->validate([
            'nim'=>'required|numeric|unique:mahasiswa,nim',
            'nama'=>'required',
            'alamat'=>'required',
            'hobi'=>'required',
        ],[
            'nim.required'=>'NIM Wajib Diisi',
            'nim.numeric'=>'NIM Wajib Dalam Angka',
            'nim.unique'=>'NIM Yang Diisikan Sudah Ada Dalam Database!',
            'nama.required'=>'Nama Wajib Diisi',
            'alamat.required'=>'Alamat Wajib Diisi',
            'hobi.required'=>'Hobi Wajib Diisi',
        ]);
        $data = [
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'hobi'=>$request->hobi,
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data');
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
        $data = mahasiswa::where('nim',$id)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'hobi'=>'required',
        ],[
            'nama.required'=>'Nama Wajib Diisi',
            'alamat.required'=>'Alamat Wajib Diisi',
            'hobi.required'=>'Hobi Wajib Diisi',
        ]);
        $data = [
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'hobi'=>$request->hobi,
        ];
        mahasiswa::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success','Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success','Berhasil melakukan delete data');
    }
}
