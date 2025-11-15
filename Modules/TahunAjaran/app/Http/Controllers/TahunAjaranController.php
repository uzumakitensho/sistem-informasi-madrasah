<?php

namespace Modules\TahunAjaran\Http\Controllers;

use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Http\Controllers\Controller;
use Modules\TahunAjaran\Http\Requests\StoreTahunAjaranRequest;
use Modules\TahunAjaran\Http\Requests\UpdateTahunAjaranRequest;
use Illuminate\Http\Request;
use DB;

class TahunAjaranController extends Controller
{
    private $viewPath = 'tahun-ajaran';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahunAjaranList = TahunAjaran::orderBy('tahun_mulai', 'ASC')->get();
        sidebarMarking($this->viewPath, 'index');
        return view('tahunajaran::index', [
            'tahunAjaranList' => $tahunAjaranList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('tahun-ajaran.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTahunAjaranRequest $request) 
    {
        try {
            $tahunMulai = intval($request->tahun_mulai);

            $checkExist = TahunAjaran::where('tahun_mulai', $tahunMulai)->count();
            if($checkExist) {
                throw new \Exception('Gagal membuat data! Pilih tahun lain!');
            }

            DB::beginTransaction();

            $newThAjaran = TahunAjaran::create([
                'tahun_mulai' => $tahunMulai,
                'tahun_akhir' => $tahunMulai+1,
            ]);
            if(!$newThAjaran) {
                throw new \Exception('Gagal membuat data!');
            }
            $idThAjaran = $newThAjaran->id;

            $semesters = ['Semester Gasal', 'Semester Genap'];
            foreach ($semesters as $semester) {
                $newSemester = Semester::create([
                    'nama' => $semester,
                    'tahun_ajaran_id' => $idThAjaran,
                ]);
            }

            DB::commit();

            return redirect()->route('tahun-ajaran.create')->with('success', 'Berhasil membuat data!');
        } catch(\Exception $err) {
            DB::rollBack();
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        return redirect()->route('tahun-ajaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return redirect()->route('tahun-ajaran.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahunAjaran) 
    {
        try {
            $tahunMulai = intval($request->tahun_mulai);

            $checkExist = TahunAjaran::where('tahun_mulai', $tahunMulai)->where('id', '<>', $tahunAjaran->id)->count();
            if($checkExist) {
                throw new \Exception('Gagal update data! Pilih tahun lain!');
            }

            if($tahunMulai != $tahunAjaran->tahun_mulai) {
                $tahunAjaran->tahun_mulai = $tahunMulai;
                $tahunAjaran->tahun_akhir = $tahunMulai+1;
                $tahunAjaran->save();
            }

            return redirect()->route('tahun-ajaran.edit', ['th_ajaran' => $tahunAjaran])->with('success', 'Tahun ajaran berhasil diupdate!');
        }  catch(\Exception $err) {
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran) 
    {
        try {
            $tahunAjaran->semesters()->delete();
            $tahunAjaran->delete();

            return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil dihapus!');
        } catch(\Exception $err) {
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }
}
