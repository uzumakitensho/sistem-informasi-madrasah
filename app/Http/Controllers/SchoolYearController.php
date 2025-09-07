<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\SchoolYear;
use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use Illuminate\Http\Request;
use DB;

class SchoolYearController extends Controller
{
    private $viewPath = 'school-years';

    public function index(Request $request)
    {
        $schoolYears = SchoolYear::orderBy('year_start', 'ASC')->get();
        sidebarMarking($this->viewPath, 'index');
        return view($this->viewPath.'.index', [
            'schoolYears' => $schoolYears,
        ]);
    }

    public function create()
    {
        sidebarMarking($this->viewPath, 'create');
        return view($this->viewPath.'.create');
    }

    public function store(StoreSchoolYearRequest $request)
    {
        try {
            $yearStart = intval($request->year_start);

            DB::beginTransaction();

            $newSchoolYear = SchoolYear::create([
                'year_start' => $yearStart,
                'year_end' => $yearStart+1,
            ]);
            if(!$newSchoolYear) {
                throw new \Exception('Failed to create data!');
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

            return redirect()->route('school-years.create')->with('success', 'School Year created!');
        } catch(\Exception $err) {
            DB::rollBack();
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }

    public function show(SchoolYear $schoolYear)
    {
        //
    }

    public function edit(SchoolYear $schoolYear)
    {
        sidebarMarking($this->viewPath, 'index');
        return view($this->viewPath.'.edit', [
            'schoolYear' => $schoolYear,
        ]);
    }

    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolYear)
    {
        $yearStart = intval($request->year_start);
        if($yearStart != $schoolYear->year_start) {
            $schoolYear->year_start = $yearStart;
            $schoolYear->year_end = $yearStart+1;
            $schoolYear->save();
        }

        return redirect()->route('school-years.edit', ['school_year' => $schoolYear])->with('success', 'School Year updated!');
    }

    public function destroy(SchoolYear $schoolYear)
    {
        try {
            $schoolYear->semesters()->delete();
            $schoolYear->delete();

            return redirect()->route('school-years.index')->with('success', 'School Year deleted!');
        } catch(\Exception $err) {
            return redirect()->back()->withErrors([$err->getMessage()]);
        }
    }
}
