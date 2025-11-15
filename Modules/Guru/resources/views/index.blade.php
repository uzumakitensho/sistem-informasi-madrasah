@extends('layouts.app')
 
@section('title', 'Guru')
 
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guruList as $key => $detailGuru)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if(!$detailGuru->is_active)
                                    {{ $detailGuru->nama_guru }}
                                    <br><strong class="text-danger">Tidak Aktif</strong>
                                    @else
                                    {{ $detailGuru->nama_guru }}
                                    @endif
                                </td>
                                <td>{{ $detailGuru->nip ?? '-' }}</td>
                                <td>
                                    <div class="dropdown mb-4">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu animated--fade-in"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('guru.edit', ['guru' => $detailGuru]) }}">Edit</a>
                                            <form method="post" action="{{ route('guru.destroy', ['guru' => $detailGuru]) }}" onsubmit="return confirm('Are you sure?')">
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