@extends('layout.app')

@section('title', 'Data Pengaduan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pengaduan</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label>Pilih Jenis Pengaduan</label>
                        <select class="form-control" name="jenis_aduans_id" id="data-pengaduan">
                            <option value="#">Semua Jenis Pengaduan</option>
                            @foreach ($jenisAduan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Berikut Data Pengaduan yang diajukan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table table-data-aduan" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pengaduan</th>
                                            <th>Created At</th>
                                            <th>Toko</th>
                                            <th>Dikomplain oleh</th>
                                            <th>Dikerjakan oleh</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporan as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->laporan }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->userPelapor->toko->nama }}</td>
                                                <td>{{ $item->userPelapor->name }}</td>
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
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false" data-bs-toggle="dropdown">
                                                            Detail
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item has-icon edit-data-pengaduan"
                                                                data-id="{{ $item->id }}" data-toggle="modal"
                                                                data-target="#modal-edit-pengaduan"><i
                                                                    class="fa-regular fa-pen-to-square"></i>
                                                                Follow Up Pengaduan</a>
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
            </div>
        </section>
        <!-- modal edit data -->
        <div class="modal fade" id="modal-edit-pengaduan" aria-hidden="true" aria-labelledby="modal-edit-pengaduan"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalToggleLabel">Edit Data Pengaduan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="form-edit-pengaduan">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="dataLaporan" class="form-label">Pengaduan</label>
                                <input type="text" class="form-control" id="dataLaporan" name="dataLaporan" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="namaPekerja" class="form-label">Dikerjakan oleh</label>
                                <input type="text" class="form-control" id="namaPekerja" name="namaPekerja" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="namaPelapor" class="form-label">Dikomplain oleh</label>
                                <input type="text" class="form-control" id="namaPelapor" name="namaPelapor"readonly>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Notes</label>
                                <input type="text" class="form-control" id="note" name="note">
                            </div>
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control status-aduan" name="status">
                                    <option value="open">Open</option>
                                    <option value="pending">Pending</option>
                                    <option value="in progress">Inprogress</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    {{-- <script src="{{ asset('js/page/index-0.js') }}"></script> --}}

    <script>
        // /data-pengaduan
    </script>
@endpush
