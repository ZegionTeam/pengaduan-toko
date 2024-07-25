@extends('layout.app')

@section('title', 'Rincian Pengaduan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/img.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rincian Pengaduan</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ route('pengaduan.update', $laporan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Rincian Aduan</label>
                                    <textarea class="form-control" data-height="250" name="laporan">{{ $laporan->laporan }}</textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>Foto Aduan</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto"
                                            accept=".jpg,.gif,.png,.jpeg,.HEIF" name="foto">
                                        <label class="custom-file-label" for="foto">Choose file</label>
                                    </div>
                                </div>
                                <img src="{{ asset('images/laporan/' . $laporan->foto) }}" alt="image" class="img-fluid"  data-toggle="modal" data-target="#imageModal"
                                    width="200" id="preview">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-12 col-md-6 text-center">
                                <button class="btn btn-primary mt-2" type="submit">Simpan</button>
                    </form>
                    <form action="{{ route('pengaduan.destroy', $laporan->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mt-2" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
        <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/laporan/' . $laporan->foto) }}" alt="image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
