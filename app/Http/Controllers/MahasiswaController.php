<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\MahasiswaMataKuliah;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        return view('mahasiswas.index', compact('mahasiswas'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari table kelas
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')){
            $image_name = $request->file('image')->store('images', 'public');
        }
    //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_lahir' => 'required',
        ]);

        //fungsi eloquent untuk menambah data
        $mahasiswas= new Mahasiswa;
        $mahasiswas->nim=$request->get('Nim');
        $mahasiswas->nama=$request->get('Nama');
        $mahasiswas->foto=$image_name;
        $mahasiswas->jurusan=$request->get('Jurusan');
        $mahasiswas->no_handphone=$request->get('No_Handphone');
        $mahasiswas->email=$request->get('Email');
        $mahasiswas->tanggal_lahir=$request->get('Tanggal_lahir');

        //fungsi eloquent untuk menambah data dengan relasi belongs to
        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
            $request->validate([
                'Nim' => 'required',
                'Nama' => 'required',
                'kelas' => 'required',
                'Jurusan' => 'required',
                'No_Handphone' => 'required',
                'Email' => 'required',
                'Tanggal_lahir' => 'required',
            ]);
            //fungsi update data inputan
            $mahasiswas = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();

            if ($mahasiswas->Foto && file_exists(storage_path('app/public/' .$mahasiswas->Foto))){
                Storage::delete('public/' .$mahasiswas->Foto);
            }
            $image_name = $request->file('image')->store('images', 'public');

           //fungsi eloquent untuk menambah data
           $mahasiswas= new Mahasiswa;
           $mahasiswas->nim=$request->get('Nim');
           $mahasiswas->nama=$request->get('Nama');
           $mahasiswas->foto=$image_name;
           $mahasiswas->jurusan=$request->get('Jurusan');
           $mahasiswas->no_handphone=$request->get('No_Handphone');
           $mahasiswas->email=$request->get('Email');
           $mahasiswas->tanggal_lahir=$request->get('Tanggal_lahir');
           
           $kelas = new Kelas;
           $kelas->id = $request->get('kelas');
           
           $mahasiswas->kelas()->associate($kelas);
           $mahasiswas->save();

           //jika data berhasil diupdate, akan kembali ke halaman utama
                return redirect()->route('mahasiswas.index')
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
            Mahasiswa::find($Nim)->delete();
           return redirect()->route('mahasiswas.index')
                -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function nilai($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        $MahasiswaMataKuliah = MahasiswaMataKuliah::where('mahasiswa_id', '=', $Nim)->get();
        return view('mahasiswas.nilai', ['Mahasiswa' => $Mahasiswa], ['MahasiswaMataKuliah' => $MahasiswaMataKuliah], compact('MahasiswaMataKuliah'));
    }

    public function cetak_pdf($Nim){
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        $MahasiswaMataKuliah = MahasiswaMataKuliah::Where('mahasiswa_id','=',$Nim)->get();
        $pdf = PDF::loadView('mahasiswas.nilai_pdf', compact('Mahasiswa', 'MahasiswaMataKuliah'));
        return $pdf->stream();
    }

};