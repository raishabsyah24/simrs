@extends('layouts.admin.master', ['title' => $title])
@section('admin-content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview wide-md mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">Ekspor Laporan Riwayat Obat Pasien</h2>
                            </div>
                        </div>
                        <div class="nk-block nk-block-lg">
                            <div class="card shadow">
                                <div class="card-inner">
                                    <form target="_blank" action="" method="post">
                                        @csrf
                                        <div class="row g-4">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label">Dari Tanggal</label>
                                                    <div class="form-control-wrap">
                                                        <input autocomplete="off" type="text" data-date-format="yyyy-mm-dd"
                                                            class="form-control date-picker form-control-lg" name="dari">
                                                        @error('dari')
                                                            <div class="invalid text-danger">
                                                                {!! $message !!}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label">Sampai Tanggal</label>
                                                    <div class="form-control-wrap">
                                                        <input autocomplete="off" type="text" data-date-format="yyyy-mm-dd"
                                                            class="form-control date-picker form-control-lg" name="sampai">
                                                        @error('sampai')
                                                            <div class="invalid text-danger">
                                                                {!! $message !!}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label">Kategori Pasien</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-control form-control-lg form-select select2"
                                                            style="position:absolute;" name="kategori_pasien"
                                                            data-placeholder="Pilih kategori pasien">
                                                            <option value="semua">Semua</option>
                                                            @foreach ($data as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label">Jenis File</label>
                                                    <div class="form-control-wrap">
                                                        <select class="form-control form-control-lg form-select select2"
                                                            style="position:absolute;" name="ekstensi"
                                                            data-placeholder="Pilih ekstensi">
                                                            <option value="" disabled selected>Pilih Tipe File</option>
                                                            <option value="pdf">PDF</option>
                                                            <option value="excel">EXCEL</option>
                                                        </select>
                                                        @error('ekstensi')
                                                            <div class="invalid text-danger">
                                                                {!! $message !!}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 offset-lg-5">
                                                <div class="form-group">
                                                    <button type="submit" onclick="submitForm(this.form)"
                                                        class="tombol-simpan btn btn-lg btn-primary">
                                                        <span class="text-simpan">Ekspor Data</span>
                                                        <span
                                                            class="loading-simpan d-none ml-2 spinner-border spinner-border-sm"
                                                            role="status" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
