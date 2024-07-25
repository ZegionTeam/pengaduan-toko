<script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            iziToast.error({
                title: '{{ $error }}',
                position: 'topRight'
            });
        @endforeach
    @endif

    @if (session('success'))
        iziToast.success({
            title: '{{ session('success') }}',
            position: 'topRight'
        });
    @endif

    @if (session('info'))
        iziToast.info({
            title: '{{ session('info') }}',
            position: 'topRight'
        });
    @endif
</script>
