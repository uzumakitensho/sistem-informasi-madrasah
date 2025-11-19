<?php

namespace Modules\Kelas\Http\Controllers;

use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Modules\Kelas\Http\Requests\StoreKelasRequest;
use Modules\Kelas\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private $viewPath = 'kelas';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasList = Kelas::orderBy('nama_kelas', 'ASC')->get();
        sidebarMarking($this->viewPath, 'index');
        return view('kelas::index', [
            'kelasList' => $kelasList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        sidebarMarking($this->viewPath, 'create');
        return view('kelas::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request) 
    {
        // dd($request->all());
        $namaKelas = strtoupper(trim($request->nama_kelas));
        $isActive = $request->is_active ? true : false;

        $kelasParts = preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $namaKelas, -1, PREG_SPLIT_NO_EMPTY);
        if(!is_array($kelasParts) || count($kelasParts) != 2 || !is_numeric($kelasParts[0])) {
            return redirect()->back()->withErrors(['Gagal membuat data kelas baru! Nama kelas invalid'])-> withInput();
        }
        $jenjang = $kelasParts[0];

        $checkExist = Kelas::where('nama_kelas', $namaKelas)->first();
        if($checkExist) {
            return redirect()->back()->withErrors(['Gagal membuat data kelas baru! Nama kelas sudah digunakan'])-> withInput();
        }

        $kelasBaru = Kelas::create([
            'nama_kelas' => $namaKelas,
            'jenjang' => $jenjang,
            'is_active' => $isActive,
        ]);
        if(!$kelasBaru) {
            return redirect()->back()->withErrors(['Gagal membuat data kelas baru!'])-> withInput();
        }

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('kelas.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kelas)
    {
        $detailKelas = Kelas::find($kelas);
        if(!$detailKelas) {
            return redirect()->route('kelas.index')->withErrors(['Data kelas tidak ditemukan!']);
        }

        sidebarMarking($this->viewPath, 'index');
        return view('kelas::edit', [
            'detailKelas' => $detailKelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, $kelas) 
    {
        $namaKelas = trim($request->nama_kelas);
        $isActive = $request->is_active ? true : false;

        $detailKelas = Kelas::find($kelas);
        if(!$detailKelas) {
            return redirect()->route('kelas.index')->withErrors(['Data kelas tidak ditemukan!']);
        }

        $kelasParts = preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $namaKelas, -1, PREG_SPLIT_NO_EMPTY);
        if(!is_array($kelasParts) || count($kelasParts) != 2 || !is_numeric($kelasParts[0])) {
            return redirect()->back()->withErrors(['Gagal merubah data kelas! Nama kelas invalid'])-> withInput();
        }
        $jenjang = $kelasParts[0];

        $checkExist = Kelas::where('id', '<>', $kelas)->where('nama_kelas', $namaKelas)->first();
        if($checkExist) {
            return redirect()->back()->withErrors(['Gagal merubah data kelas! Nama kelas sudah digunakan'])-> withInput();
        }

        $detailKelas->nama_kelas = $namaKelas;
        $detailKelas->jenjang = $jenjang;
        $detailKelas->is_active = $isActive;
        if(!$detailKelas->save()) {
            return redirect()->back()->withErrors(['Gagal merubah data kelas!'])-> withInput();
        }

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
