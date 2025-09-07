<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    private $viewPath = 'school-years';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        sidebarMarking($this->viewPath, 'index');
        return view($this->viewPath.'.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        sidebarMarking($this->viewPath, 'create');
        return view($this->viewPath.'.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolYearRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear)
    {
        //
    }
}
