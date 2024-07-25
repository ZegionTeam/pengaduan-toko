@extends('layout.app')

@section('title', 'Follow Up Karyawan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Follow Up Pengaduan</h1>
            </div>
            <div class="timeline">
                <div class="timeline-item left">
                    <span class="icon icon-info icon-lg"><i class="fa-solid fa-folder-open"></i></span>
                    <h3 class="my-3 text-primary">Open</h3>
                    <h6 class="my-3">{{ $laporan->created_at }}</h6>
                    <p>{{ $laporan->laporan }}</p>
                </div>
                @if (count($history) != 0)
                    @foreach ($history as $index => $item)
                        @if (($index + 1) % 2 == 0)
                            <div class="timeline-item left">
                            @else
                                <div class="timeline-item right">
                        @endif
                        @if ($item->after == 'open')
                            <span class="icon icon-info icon-lg"><i class="fa-solid fa-folder-open"></i></span>
                            <h3 class="my-3 text-primary">Open</h3>
                        @elseif ($item->after == 'completed')
                            <span class="icon icon-info icon-lg"><i class="fa-solid  fa-circle-check"></i></span>
                            <h3 class="my-3 text-primary">Completed</h3>
                        @elseif ($item->after == 'in progress')
                            <span class="icon icon-info icon-lg"><i class="fa-solid fa-bars-progress"></i></span>
                            <h3 class="my-3 text-primary">Inprogress</h3>
                        @elseif ($item->after == 'pending')
                            <span class="icon icon-info icon-lg"><i class="fa-solid  fa-spinner"></i></span>
                            <h3 class="my-3 text-primary">Pending</h3>
                        @endif
                        <h6 class="my-3">{{ $item->created_at }}</h6>
                        <p>{{ $item->note }}</p>
            </div>
            @endforeach
            @endif
    </div>
    @php
        $lastStatus = '';
        if (count($history) != 0) {
            $lastIndex = count($history);
            $lastStatus = $history[$lastIndex - 1]->after;
        }
    @endphp
    @if ($lastStatus !== 'completed')
        <form action="/laporan-selesai/{{ $laporan->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-6 text-center">
                    <button class="btn btn-primary mt-2" type="submit">Selesaikan dan Tutup Pengaduan</button>
                </div>
            </div>
        </form>
    @endif
    </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
