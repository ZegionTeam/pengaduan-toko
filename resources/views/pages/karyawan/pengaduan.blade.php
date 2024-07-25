@extends('layout.app')

@section('title', 'Lihat Pengaduan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Lihat Pengaduan</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label>Pilih Jenis Pengaduan</label>
                        <select class="form-control" name="jenis_aduans_id" id="jenis_aduans_id">
                            <option value="#">Semua Jenis Pengaduan</option>
                            @foreach ($jenisAduan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Lihat Aduan</h4>
                                    <div class="card-header-form">
                                        {{-- <button class="btn btn-primary" type="button">Tambah Pengaduan</button> --}}
                                        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">Tambah
                                            Pengaduan</a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table-striped table table-pengaduan" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Pengaduan</th>
                                                    <th>Created At</th>
                                                    <th>Toko</th>
                                                    <th>Pelapor</th>
                                                    <th>Dikerjakan</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($laporan as $index => $item)
                                                    <tr>
                                                        <td>
                                                            {{ $index + 1 }}
                                                        </td>
                                                        <td>{{ $item->laporan }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>
                                                            {{ $item->userPelapor->name }}
                                                        </td>
                                                        <td>
                                                            @if ($item->userPekerja)
                                                                {{ $item->userPekerja->name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->status == 'open')
                                                                <div class="badge badge-primary">Open</div>
                                                            @elseif ($item->status == 'completed')
                                                                <div class="badge badge-success">Completed</div>
                                                            @elseif ($item->status == 'in progress')
                                                                <div class="badge badge-danger">Inprogress</div>
                                                            @elseif ($item->status == 'pending')
                                                                <div class="badge badge-warning">Pending</div>
                                                            @else
                                                                <div class="badge badge-secondary">Unknown Status</div>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <div class="dropdown d-inline">
                                                                <button class="btn btn-primary dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false"
                                                                    data-bs-toggle="dropdown">
                                                                    Detail
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item has-icon"
                                                                        href="{{ route('pengaduan.edit', $item->id) }}"><i
                                                                            class="fa-regular fa-pen-to-square"></i>Edit
                                                                        Data</a>
                                                                    <a class="dropdown-item has-icon"
                                                                        href="/followupkaryawan/{{ $item->id }}"><i
                                                                            class="fa-solid fa-circle-info"></i>Follow Up
                                                                        Laporan</a>
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
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
