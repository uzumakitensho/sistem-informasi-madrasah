@extends('layouts.app')
 
@section('title', 'Tahun Ajaran')
 
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tahun Ajaran</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Tahun Pelajaran</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schoolYears as $key => $schoolYear)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $schoolYear->year_start .' - '. $schoolYear->year_end }}</td>
                                <td>
                                    <ul>
                                        @foreach($schoolYear->semesters()->get() as $semester)
                                            @if(boolval($semester->is_active))
                                            <li style="padding-top: 3px; padding-bottom: 3px;"><strong style="color: green;">{{ strtoupper($semester->name) }}</strong></li>
                                            @else
                                            <li style="padding-top: 3px; padding-bottom: 3px;">{{ $semester->name }} <button class="btn btn-sm btn-outline-warning">Activate</button></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="dropdown mb-4">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu animated--fade-in"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('school-years.edit', ['school_year' => $schoolYear]) }}">Edit</a>
                                            <form method="post" action="{{ route('school-years.destroy', ['school_year' => $schoolYear]) }}" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                <button class="dropdown-item" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection