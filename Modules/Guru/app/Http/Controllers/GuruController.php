<?php

namespace Modules\Guru\Http\Controllers;

use App\Models\Guru;
use App\Http\Controllers\Controller;
use Modules\Guru\Http\Requests\StoreGuruRequest;
use Modules\Guru\Http\Requests\UpdateGuruRequest;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    private $viewPath = 'guru';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guruList = Guru::orderBy('nama_guru', 'ASC')->get();
        sidebarMarking($this->viewPath, 'index');
        return view('guru::index', [
            'guruList' => $guruList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        sidebarMarking($this->viewPath, 'create');
        return view('guru::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request) 
    {
        // dd($request->all());
        $namaGuru = trim($request->nama_guru);
        $kelamin = $request->kelamin;
        $nip = $request->nip ?? null;
        $isActive = $request->is_active ? true : false;

        $checkExist = Guru::where('nama_guru', $namaGuru);
        if($nip) {
            $checkExist = $checkExist->orWhere('nip', $nip);
        }
        $checkExist = $checkExist->first();
        if($checkExist) {
            return redirect()->back()->withErrors(['Gagal membuat data guru baru! Nama dan/atau NIP sudah digunakan'])-> withInput();
        }

        $guruBaru = Guru::create([
            'nama_guru' => $namaGuru,
            'kelamin' => $kelamin,
            'nip' => $nip,
            'is_active' => $isActive,
        ]);
        if(!$guruBaru) {
            return redirect()->back()->withErrors(['Gagal membuat data guru baru!'])-> withInput();
        }

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('guru.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $guru)
    {
        $detailGuru = Guru::find($guru);
        if(!$detailGuru) {
            return redirect()->route('guru.index')->withErrors(['Data guru tidak ditemukan!']);
        }

        sidebarMarking($this->viewPath, 'index');
        return view('guru::edit', [
            'detailGuru' => $detailGuru,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, $guru) 
    {
        $namaGuru = trim($request->nama_guru);
        $kelamin = $request->kelamin;
        $nip = $request->nip ?? null;
        $isActive = $request->is_active ? true : false;

        $detailGuru = Guru::find($guru);
        if(!$detailGuru) {
            return redirect()->route('guru.index')->withErrors(['Data guru tidak ditemukan!']);
        }

        $checkExist = Guru::where('id', '<>', $guru)->where(function($query) use($namaGuru, $nip) {
            $query->where('nama_guru', $namaGuru);
            if($nip) {
                $query->orWhere('nip', $nip);
            }
        })->first();
        if($checkExist) {
            return redirect()->back()->withErrors(['Gagal merubah data guru! Nama dan/atau NIP sudah digunakan'])-> withInput();
        }

        $detailGuru->nama_guru = $namaGuru;
        $detailGuru->kelamin = $kelamin;
        $detailGuru->nip = $nip;
        $detailGuru->is_active = $isActive;
        if(!$detailGuru->save()) {
            return redirect()->back()->withErrors(['Gagal merubah data guru!'])-> withInput();
        }

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru) 
    {
        try {
            $guru->delete();

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
        } catch(\Exception $err) {
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }
}
