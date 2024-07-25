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
                        <form action="{{ route('stores.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="namatoko" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="namatoko" name="nama" placeholder="Masukkan Nama Toko Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamattoko" class="form-label">Alamat Toko</label>
                                <input type="text" class="form-control" id="alamattoko" name="alamat" placeholder="Masukkan Alamat Toko Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-control" name="province_id" id="provinsi">
                                    <option selected disabled>Pilih Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="regency" class="form-label">Regency</label>
                                <select class="form-control" name="regency_id" id="regency">
                                    <option selected disabled>Pilih Regency</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">District</label>
                                <select class="form-control" name="district_id" id="district">
                                    <option selected disabled>Pilih District</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="village" class="form-label">Village</label>
                                <select class="form-control" name="village_id" id="village" required>
                                    <option selected disabled>Pilih Village</option>
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
        var provinceId = this.value;
        $('#regency').html('<option value="">Pilih Regency</option>');
        $.ajax({
            url: "{{ route('getRegencies') }}",
            type: "POST",
            data: {
                province_id: provinceId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    $('#regency').append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    });

    $('#regency').on('change', function() {
        var regencyId = this.value;
        $('#district').html('<option value="">Pilih District</option>');
        $.ajax({
            url: "{{ route('getDistricts') }}",
            type: "POST",
            data: {
                regency_id: regencyId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    $('#district').append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    });

    $('#district').on('change', function() {
        var districtId = this.value;
        $('#village').html('<option value="">Pilih Village</option>');
        $.ajax({
            url: "{{ route('getVillages') }}",
            type: "POST",
            data: {
                district_id: districtId,
                _token: '{{csrf_token()}}'
            },
            
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    $('#village').append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    });
});
</script>
@endpush
