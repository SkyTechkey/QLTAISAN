@push('page_css')
    <link rel="stylesheet" href={{ URL::asset('css/media-image.css') }}>
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href={{ URL::asset('plugins/ekko-lightbox/ekko-lightbox.css') }}>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href={{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- Music Player -->
    <link rel="stylesheet" href={{ URL::asset('css/music-player.css') }}>
    {{-- Dropzone --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href={{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}>
@endpush