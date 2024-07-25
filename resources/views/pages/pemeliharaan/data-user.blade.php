@extends('layout.app')

@section('title', 'Data User')

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
                <h1>Data User</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data User</h4>
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
                                            <th>NIK</th>
                                            <th>Role</th>
                                            <th>Toko</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $item)
                                            <tr>
                                                <td>
                                                    {{ $index + 1 }}
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    {{ $item->nik }}
                                                </td>
                                                <td>{{ $item->role }}</td>
                                                <td>{{ $item->toko->nama }}</td>

                                                <td><button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        data-bs-toggle="dropdown">
                                                        Detail
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item has-icon edit-user"
                                                            data-id="{{ $item->id }}"><i
                                                                class="fa-regular fa-pen-to-square"></i>Edit</a>
                                                        <form action="{{ route('users.destroy', $item->id) }}"
                                                            method="POST" id="hapus-user-{{ $item->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a
                                                                class="dropdown-item has-icon"onclick="document.getElementById('hapus-user-{{ $item->id }}').submit(); return false;"><i
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
        <!-- modal edit data -->
        <div class="modal fade" id="editUser" aria-hidden="true" aria-labelledby="editUser" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalToggleLabel">Edit Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="form-edit-user">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="namaUser" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="namaUser" name="name"
                                    placeholder="Masukkan Pengaduan Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="roleUser" class="form-label">Role</label>
                                <select class="form-control" name="role" id="roleUser">
                                    <option value="karyawan">Karyawan</option>
                                    <option value="pemeliharaan">Pemeliharaan</option>
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
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
