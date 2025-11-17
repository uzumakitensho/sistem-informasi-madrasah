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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Guru</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('guru.store') }}">
                        @csrf
                        <div class="col-lg-5 mb-3">
                            <label for="namaGuruInput" class="form-label">Nama Guru <span class="required">*</span></label>
                            <input type="text" class="form-control" name="nama_guru" id="namaGuruInput" required>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label for="nipGuruInput" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nipGuruInput">
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label for="nipGuruInput" class="form-label">Jenis Kelamin <span class="required">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kelamin" value="L" checked>
                                <label class="form-check-label">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kelamin" value="P">
                                <label class="form-check-label">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <label for="nipGuruInput" class="form-label">Masih Aktif <span class="required">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="1" checked>
                                <label class="form-check-label">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="0">
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