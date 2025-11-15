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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Tahun Ajaran</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('tahun-ajaran.store') }}">
                        @csrf
                        <div class="col-lg-4 mb-3">
                            <label for="tahunMulaiInput" class="form-label">Tahun Mulai</label>
                            <input type="number" class="form-control" name="tahun_mulai" id="tahunMulaiInput" min="1990" max="5000" required>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

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
                            @foreach($tahunAjaranList as $key => $thAjaran)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $thAjaran->tahun_mulai .' - '. $thAjaran->tahun_akhir }}</td>
                                <td>
                                    <ul>
                                        @foreach($thAjaran->semesters()->get() as $semester)
                                            @if(boolval($semester->is_active))
                                            <li style="padding-top: 3px; padding-bottom: 3px;"><strong style="color: green;">{{ strtoupper($semester->nama) }}</strong></li>
                                            @else
                                            <li style="padding-top: 3px; padding-bottom: 3px;">
                                                {{ $semester->nama }} 
                                                <form method="post" action="{{ route('semesters.activate', ['semester' => $semester]) }}" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-warning" type="submit">Activate</button>
                                                </form>
                                            </li>
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
                                            <a class="dropdown-item" href="{{ route('tahun-ajaran.edit', ['tahun_ajaran' => $thAjaran]) }}">Edit</a>
                                            <form method="post" action="{{ route('tahun-ajaran.destroy', ['tahun_ajaran' => $thAjaran]) }}" onsubmit="return confirm('Are you sure?')">
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