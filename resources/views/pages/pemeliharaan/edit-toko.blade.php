@extends('layout.app')

@section('title', 'Tambah Data Toko')

@push('style')
    <!-- Include necessary CSS files -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Toko</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Masukkan Data Toko</h4>
                        </div>
                        <div class="card-body">
                            <!-- Create/Edit Toko Form -->
                            <form action="{{ route('toko.update', $dataToko->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="namatoko" class="form-label">Nama Toko</label>
                                    <input type="text" class="form-control" id="namatoko" name="nama"
                                        placeholder="Masukkan Nama Toko Anda" required value="{{ $dataToko->nama }}">
                                </div>
                                <div class="mb-3">
                                    <label for="alamattoko" class="form-label">Alamat Toko</label>
                                    <input type="text" class="form-control" id="alamattoko" name="alamat"
                                        placeholder="Masukkan Alamat Toko Anda" required value="{{ $dataToko->alamat }}">
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select class="form-control" name="province_id" id="provinsi">
                                        <option selected disabled>Pilih Provinsi</option>
                                        @foreach ($province as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $p->id == $dataToko->village->district->regency->province_id ? 'selected' : '' }}>
                                                {{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="regency" class="form-label">Regency</label>
                                    <select class="form-control" name="regency_id" id="regency">
                                        <option selected disabled>Pilih Regency</option>
                                        @foreach ($regency as $r)
                                            <option value="{{ $r->id }}"
                                                {{ $r->id == $dataToko->village->district->regency_id ? 'selected' : '' }}>
                                                {{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <select class="form-control" name="district_id" id="district">
                                        <option selected disabled>Pilih District</option>
                                        @foreach ($district as $d)
                                            <option value="{{ $d->id }}"
                                                {{ $d->id == $dataToko->village->district_id ? 'selected' : '' }}>
                                                {{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="village" class="form-label">Village</label>
                                    <select class="form-control" name="village_id" id="village" required>
                                        <option selected disabled>Pilih Village</option>
                                        @foreach ($villages as $v)
                                            <option value="{{ $v->id }}"
                                                {{ $v->id == $dataToko->villages_id ? 'selected' : '' }}>
                                                {{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#provinsi').on('change', function() {
                // reset all option below province
                var regency = $('#regency').find('option:first').clone();
                $('#regency').empty().append(regency);
                var district = $('#district').find('option:first').clone();
                $('#district').empty().append(district);
                var village = $('#village').find('option:first').clone();
                $('#village').empty().append(village);

                var id = this.value
                console.log(id);
                $.get('/get-regencies/' + id, function(data) {
                    data.forEach(element => {
                        $('#regency').append('<option value="' + element.id + '">' +
                            element.name + '</option>');
                    });
                })
            });

            $('#regency').on('change', function() {
                var district = $('#district').find('option:first').clone();
                $('#district').empty().append(district);
                var village = $('#village').find('option:first').clone();
                $('#village').empty().append(village);
                var id = this.value
                $.get('/get-districts/' + id, function(data) {
                    data.forEach(element => {
                        $('#district').append('<option value="' + element.id + '">' +
                            element.name + '</option>');
                    });
                })
            });

            $('#district').on('change', function() {
                var village = $('#village').find('option:first').clone();
                $('#village').empty().append(village);
                var id = this.value
                $.get('/get-villages/' + id, function(data) {
                    data.forEach(element => {
                        $('#village').append('<option value="' + element.id + '">' +
                            element.name + '</option>');
                    });
                })
            });
        });
    </script>
@endpush
