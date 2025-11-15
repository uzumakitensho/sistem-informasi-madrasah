<?php

namespace Modules\TahunAjaran\Http\Controllers;

use App\Models\Semester;
use App\Models\SchoolYear;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TahunAjaranController extends Controller
{
    private $viewPath = 'school-years';
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        return view('tahunajaran::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('tahunajaran::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('tahunajaran::edit');
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
