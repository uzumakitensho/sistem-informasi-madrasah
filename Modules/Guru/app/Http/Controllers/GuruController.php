<?php

namespace Modules\Guru\Http\Controllers;

use App\Models\Guru;
use App\Http\Controllers\Controller;
use Modules\Guru\Http\Requests\StoreGuruRequest;
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
        return view('guru::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('guru::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
