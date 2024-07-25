@extends('layout.app')

@section('title', 'Pengaduan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/img.css') }}">
    <script src=" https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengaduan</h1>
            </div>
            <form action="{{ route('pengaduan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Pilih Jenis Pengaduan</label>
                            <select class="form-control" name="jenis_aduans_id">
                                @foreach ($jenisAduan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Buat Pengaduan Anda</label>
                                    <textarea class="form-control" data-height="250" name="laporan"></textarea>
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
                                <img src="{{ asset('images/img-preview.png') }}" alt="image" class="img-fluid"
                                    width="200" id="preview">
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-12 col-md-6 text-center">
                                <button class="btn btn-primary" type="submit">Buat Pengaduan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
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

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
    {{-- Preview image --}}
    <script>
        foto.onchange = evt => {
            preview = document.getElementById('preview');
            // preview.style.display = 'block';
            const [file] = foto.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <!-- notification -->
    @include('components.notification')
@endpush
