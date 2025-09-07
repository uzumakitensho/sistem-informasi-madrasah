@extends('layouts.app')
 
@section('title', 'School Years')
 
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit School Years</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('school-years.update', ['school_year' => $schoolYear]) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="yearStartInput" class="form-label">Year Start</label>
                            <input type="number" class="form-control" name="year_start" id="yearStartInput" value="{{ $schoolYear->year_start }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection