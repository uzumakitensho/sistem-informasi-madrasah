<?php

namespace Modules\TahunAjaran\Http\Controllers;

use App\Models\Semester;
use App\Models\SchoolYear;
use App\Http\Controllers\Controller;
use Modules\TahunAjaran\Http\Requests\StoreTahunAjaranRequest;
use Modules\TahunAjaran\Http\Requests\UpdateTahunAjaranRequest;
use Illuminate\Http\Request;
use DB;

class TahunAjaranController extends Controller
{
    private $viewPath = 'school-years';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::orderBy('year_start', 'ASC')->get();
        sidebarMarking($this->viewPath, 'index');
        return view('tahunajaran::index', [
            'schoolYears' => $schoolYears,
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
            $yearStart = intval($request->tahun_mulai);

            $checkExist = SchoolYear::where('year_start', $yearStart)->count();
            if($checkExist) {
                throw new \Exception('Gagal membuat data! Pilih tahun lain!');
            }

            DB::beginTransaction();

            $newSchoolYear = SchoolYear::create([
                'year_start' => $yearStart,
                'year_end' => $yearStart+1,
            ]);
            if(!$newSchoolYear) {
                throw new \Exception('Gagal membuat data!');
            }
            $idSchoolYear = $newSchoolYear->id;

            $semesters = ['Semester Gasal', 'Semester Genap'];
            foreach ($semesters as $semester) {
                $newSemester = Semester::create([
                    'name' => $semester,
                    'school_year_id' => $idSchoolYear,
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
    public function show(SchoolYear $schoolYear)
    {
        return redirect()->route('tahun-ajaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        return redirect()->route('tahun-ajaran.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTahunAjaranRequest $request, SchoolYear $schoolYear) 
    {
        try {
            $yearStart = intval($request->year_start);

            $checkExist = SchoolYear::where('year_start', $yearStart)->where('id', '<>', $schoolYear->id)->count();
            if($checkExist) {
                throw new \Exception('Gagal update data! Pilih tahun lain!');
            }

            if($yearStart != $schoolYear->year_start) {
                $schoolYear->year_start = $yearStart;
                $schoolYear->year_end = $yearStart+1;
                $schoolYear->save();
            }

            return redirect()->route('tahun-ajaran.edit', ['school_year' => $schoolYear])->with('success', 'School Year updated!');
        }  catch(\Exception $err) {
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear) 
    {
        try {
            $schoolYear->semesters()->delete();
            $schoolYear->delete();

            return redirect()->route('tahun-ajaran.index')->with('success', 'School Year deleted!');
        } catch(\Exception $err) {
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }
}
