@extends('layout.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            @if (Auth::user()->role == 'karyawan')
                {{-- section toko --}}
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fa-regular fa-folder-open fa-xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Open</h4>
                                </div>
                                <div class="card-body">
                                    {{ $laporan[0]['jumlah'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fa-solid fa-bars-progress fa-xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>In Progress</h4>
                                </div>
                                <div class="card-body">
                                    {{ $laporan[2]['jumlah'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fa-solid fa-spinner fa-xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pending</h4>
                                </div>
                                <div class="card-body">
                                    {{ $laporan[1]['jumlah'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fa-solid fa-circle-check fa-xl" style="color: #ffffff;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Terselesaikan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $laporan[3]['jumlah'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- row toko --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>Sistem Pengaduan Maintenance {{ Auth::user()->toko->nama }}</h5>
                                <h4>PT INDOMARCO PRISMATAMA CABANG TANGERANG 1</h4>
                                <h5>Alamat : {{ Auth::user()->toko->alamat }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end section toko --}}
            @elseif(Auth::user()->role == 'pemeliharaan')
                <h4>Pengaduan Masuk</h4>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @php
                                        $chunks = $tokos->chunk(3);
                                    @endphp

                                    @foreach ($chunks as $chunk)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach ($chunk as $dataToko)
                                                    <div class="col-md-4 mb-3">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4>{{ $dataToko->nama }}</h4>
                                                                <p>{{ $dataToko->alamat }}</p>
                                                                @foreach ($jenisLaporanPerToko as $jenisItem)
                                                                    @if ($dataToko->nama == $jenisItem['nama_toko'])
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <img class="img-fluid" alt="100%x280"
                                                                                    src="https://images.unsplash.com/photo-1532777946373-b6783242f211?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=8ac55cf3a68785643998730839663129">
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <h6>Rak Barang :
                                                                                    {{ $jenisItem['Rak Barang'] }}
                                                                                </h6>
                                                                                <h6>Lemari Pendingin :
                                                                                    {{ $jenisItem['Lemari Pendingin'] }}
                                                                                </h6>
                                                                                <h6>Meja Kasir :
                                                                                    {{ $jenisItem['Meja Kasir'] }}</h6>
                                                                                <h6>Perbaikan AC :
                                                                                    {{ $jenisItem['Perbaikan AC'] }}
                                                                                </h6>
                                                                                <h6>Lampu Toko :
                                                                                    {{ $jenisItem['Lampu Toko'] }}</h6>
                                                                                <h6>Pintu Utama/Rolling Dor :
                                                                                    {{ $jenisItem['Pintu Utama/Loring Dor'] }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button"
                                data-slide="prev">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button"
                                data-slide="next">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <h4>Progress Pengaduan</h4>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div id="carouselprosespengaduan" class="carousel slide" data-ride="carousel">
                                @foreach ($chunks as $chunk)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="row">
                                            @foreach ($chunk as $dataToko)
                                                <div class="col-md-4 mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4>{{ $dataToko->nama }}</h4>
                                                            @foreach ($statusLaporanPerToko as $item)
                                                                @if ($item->nama_toko == $dataToko->nama)
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h6>Open :</h6>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            {{ $item->open }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h6>Pending :</h6>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            {{ $item->pending }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h6>Inprogress :</h6>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            {{ $item->inprogress }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h6>Completed :</h6>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            {{ $item->complete }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <a class="btn btn-primary mb-3 mr-1" href="#carouselprosespengaduan" role="button"
                                data-slide="prev">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a class="btn btn-primary mb-3 " href="#carouselprosespengaduan" role="button"
                                data-slide="next">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- admin --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>PT INDOMARCO PRISMATAMA CABANG TANGERANG 1</h4>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end section admin --}}
            @endif
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
    {{-- <script src="{{ asset('js/page/index-0.js') }}"></script> --}}
@endpush
