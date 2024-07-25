@extends('layout.app')

@section('title', 'Data Toko')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <!-- quill js -->
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet" />
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Toko</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Toko</h4>
                            <div class="card-header-form">
                                <a href="{{ route('toko.create') }}" class="btn btn-primary">Tambah
                                    Toko</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kabupaten / Kota</th>
                                            <th>Provinsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($toko as $index => $item)
                                            <tr>
                                                <td>
                                                    {{ $index + 1 }}
                                                </td>
                                                <td>{{ $item->nama }}</td>
                                                <td>
                                                    {{ $item->alamat }}
                                                </td>
                                                <td>{{ $item->village->district->regency->name }}</td>
                                                <td>{{ $item->village->district->regency->province->name }}</td>

                                                <td><button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-bs-toggle="dropdown">
                                                        Detail
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('toko.edit', $item->id) }}"
                                                            class="dropdown-item has-icon edit-user"><i
                                                                class="fa-regular fa-pen-to-square"></i>Edit</a>
                                                        <form action="{{ route('toko.destroy', $item->id) }}"
                                                            method="POST" id="hapus-toko-{{ $item->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="dropdown-item has-icon"onclick="
                                                                                        document.getElementById('hapus-toko-{{ $item->id }}').submit();
                                                                                        return false;"><i
                                                                    class="fa-solid fa-trash"></i>Hapus</a>

                                                        </form>
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

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
