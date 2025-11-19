@extends('layouts.app')
 
@section('title', 'Kelas')
 
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kelas</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('kelas.update', ['kelas' => $detailKelas]) }}">
                        @csrf
                        <div class="col-lg-5 mb-3">
                            <label for="namaKelasInput" class="form-label">Nama Kelas <span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama_kelas" id="namaKelasInput" value="{{ $detailKelas->nama_kelas }}" required>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label class="form-label">Masih Aktif <span class="required">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="1" {{ $detailKelas->is_active ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="0" {{ !$detailKelas->is_active ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Tidak
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection