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

        $checkExist = Kelas::where('nama_kelas', $namaKelas)->first();
        if($checkExist) {
            return redirect()->back()->withErrors(['Gagal membuat data kelas baru! Nama kelas sudah digunakan'])-> withInput();
        }

        $kelasBaru = Kelas::create([
            'nama_kelas' => $namaKelas,
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
        return view('kelas::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('kelas::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
