@extends('layouts.index')
@include('content.css-content');
@section('content')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body">
                <div>
                    <div class="mb-2">
                        <div class="float-left">
                            @if($content_id)
                                @can('create_content', User::class)
                                    <a class="btn btn-secondary" href="javascript:void(0)" data-toggle="modal"
                                    data-target="#newFiles">
                                    New Files </a>
                                @endcan
                            @endif
                        </div>

                        @if ($content_id)
                            <div>
                                <form action="/search-file" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row pl-3">
                                        <label for="searchInfo" class="col-form-label">Content</label>
                                        <div class="col-sm-3">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="searchInfo"
                                                name="searchInfo"
                                                @if($search)
                                                    value="{{ $search }}"
                                                @else
                                                    placeholder="Search..."
                                                @endif
                                            >
                                        </div>
                                        <label for="fdate" class="col-form-label">From</label>
                                        
                                        <div class="col-sm-2">
                                            <input type="date"
                                                class="form-control"
                                                name="fdate"
                                                id="fdate"
                                                @if($fdate)
                                                    value="{{ explode(' ', $fdate)[0] }}"
                                                @endif
                                            >
                                        </div>
                                        <label for="ldate" class="col-form-label">To</label>
                                        <div class="col-sm-2">
                                            <input type="date"
                                                class="form-control"
                                                name="ldate"
                                                id="ldate"
                                                @if($ldate)
                                                    value="{{ explode(' ', $ldate)[0] }}"
                                                @endif
                                            >
                                        </div>
                                        <input hidden class="form-control" name="content_id" value={{ $content_id }}>
                                        <button type="submit" class="btn btn-primary">Search</button>
                        @endif
                        <div class="btn-group ml-2">
                            <a id="list" class="btn btn-default" href="javascript:void(0)"> List view </a>
                            <a id="icons" class="btn btn-default" href="javascript:void(0)"> Grid view </a>
                        </div>
                        @if ($content_id)
                    </div>
                    </form>
                </div>
                @endif
                <div class="modal fade" id="newFiles">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Upload Files</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="upload-area mb-5">
                                {{-- <form action="/content-detail" method="post" enctype="multipart/form-data"> --}}
                                {{-- @csrf --}}
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <input id="content_id" value="{{ $content_id }}" hidden>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" rows="3" id="note" placeholder="Note..."></textarea>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="privacy">
                                    <label for="privacy">Public</label>
                                </div>
                                <div>
                                    <form action="/content-detail" class="dropzone" id="dropzone" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="media">
            <div class="p-0 row">
                @foreach ($contents as $file)
                    @if (in_array($file->type, ['jpeg', 'jpg', 'png', 'jfif']))
                        <div class="media-item media-grid">
                            <a href={{ $file->link }} data-toggle="lightbox" data-title="Preview Image"
                                data-gallery="gallery">
                                <div class="file-img" style="display: none">
                                    <i class="fas fa-file-image mr-2 file-icon text-indigo" style="display: none"></i>
                                    <span class="file-name" style="display: none">{{ $file->name }}</span>
                                </div>
                            </a>
                            <div class="card media-content box-shadow">
                                <a href={{ $file->link }} data-toggle="lightbox" data-title="Preview Image"
                                    data-gallery="gallery">
                                    <div class="media-image">
                                        <img src={{ $file->link_thumbnail }} width="100%" alt="file" />
                                    </div>
                                </a>
                                <div class="p-2 large">
                                    <div style="color: #000" class="media-name">{{ $file->name }}</div>
                                    <div class="text-muted fs-12">{{ $file->size }}</div>
                                    <div class="text-muted fs-12">{{ explode(' ', $file->created_at)[0] }}
                                    </div>
                                    @if ($file->privacy)
                                        <span class="media-privacy" data-toggle="modal"
                                            data-target="#file_path{{ $file->id }}">{{ $file->privacy }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown dropdown-media">
                                <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form action="/content-detail/{{ $file->id }}" method="POST">
                                        <div class="row">
                                            <div class="col text-end">
                                                @can('update_content', User::class)
                                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#file{{ $file->id }}">
                                                        Rename
                                                    </button>
                                                @endcan
                                                @can('download_content', User::class)
                                                    <a href="/content-detail/download/{{ $file->id }}"
                                                        class="dropdown-item">Download</a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('delete_content', User::class)
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                @endcan
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        @if (!$content_id)
                            <div class="media-item media-grid">
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#play-music{{ $file->id }}">
                                    <div class="file-img" style="display: none">
                                        @if ($file->type == 'mp3')
                                            <i class="fas fa-music mr-2 file-icon"
                                                style="display: none; color: #15aabf;"></i>
                                        @else
                                            <i class="fas fa-film mr-2 file-icon" style="display: none; color: #f783ac"></i>
                                        @endif
                                        <span class="file-name" style="display: none">{{ $file->name }}</span>
                                    </div>
                                </a>
                                <div class="card media-content box-shadow">
                                    <a href="javascript:void(0)" data-toggle="modal"
                                        data-target="#play-music{{ $file->id }}">
                                        <div class="media-image">
                                            @if ($file->type == 'mp3')
                                                <i class="fas fa-music mr-2" style="color: #15aabf;"></i>
                                            @else
                                                <i class="fas fa-film mr-2" style="color: #f783ac"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="p-2 large">
                                        <div style="color: #000" class="media-name">{{ $file->name }}
                                        </div>
                                        <div class="text-muted fs-12">{{ $file->size }}</div>
                                        <div class="text-muted fs-12">
                                            {{ explode(' ', $file->created_at)[0] }}
                                        </div>
                                        @if ($file->privacy)
                                            <span class="media-privacy" data-toggle="modal"
                                                data-target="#file_path{{ $file->id }}">{{ $file->privacy }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="dropdown dropdown-media">
                                    <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="/content-detail/{{ $file->id }}" method="POST">
                                            <div class="row">
                                                <div class="col text-end">
                                                    @can('update_content', User::class)
                                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#file{{ $file->id }}">
                                                            Rename
                                                        </button>
                                                    @endcan
                                                    @can('download_content', User::class)
                                                        <a href="/content-detail/download/{{ $file->id }}" class="dropdown-item">Download</a>
                                                    @endcan

                                                    @csrf
                                                    @method('DELETE')
                                                    @can('delete_content', User::class)
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="media-item-mp3 media-grid-mp3">
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#play-music{{ $file->id }}">
                                    @if ($file->type == 'mp3')
                                        <i class="fas fa-music mr-2 file-icon" style="display: none; color: #15aabf"></i>
                                    @else
                                        <i class="fas fa-film mr-2 file-icon" style="display: none; color: #f783ac"></i>
                                    @endif
                                    <span class="file-name" style="display: none">{{ $file->name }}</span>
                                </a>
                                <div class="media-content-mp3">
                                    <a href="javascript:void(0)" data-toggle="modal"
                                        data-target="#play-music{{ $file->id }}">
                                        <div>
                                            @if ($file->type == 'mp3')
                                                <i class="fas fa-music"></i>
                                            @else
                                                <i class="fas fa-film" style="color: #f783ac"></i>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="p-2 large">
                                        <a href="javascript:void(0)" data-toggle="modal"
                                            data-target="#play-music{{ $file->id }}">
                                            <div style="color: #000" class="media-name">{{ $file->name }}</div>
                                            <div class="text-muted fs-12">
                                                {{ explode(' ', $file->created_at)[0] }}
                                            </div>
                                            <div class="text-muted fs-12">User: admin</div>
                                        </a>
                                        @if ($file->privacy)
                                            <span class="media-privacy" data-toggle="modal"
                                                data-target="#file_path{{ $file->id }}">{{ $file->privacy }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="dropdown dropdown-media-mp3">
                                    <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="/content-detail/{{ $file->id }}" method="POST">
                                            <div class="row">
                                                <div class="col text-end">
                                                    @can('update_content', User::class)
                                                    <button type="button" class="dropdown-item" data-toggle="modal"
                                                        data-target="#file{{ $file->id }}">
                                                        Rename
                                                    </button>
                                                @endcan
                                                @can('download_content', User::class)
                                                    <a href="/content-detail/download/{{ $file->id }}" class="dropdown-item">Download</a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('delete_content', User::class)
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                @endcan
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Modal Music Player Start --}}
                        <div class="modal fade" id="play-music{{ $file->id }}">
                            <div class="modal-dialog ">
                                <div class="modal-content modal-mp3">
                                    <div class="wrapper-mp3">
                                        @if ($file->type == 'mp4')
                                            <video class="icon-area icon-area-mp4" id="main-audio{{ $file->id }}"
                                                src={{ $file->link }}></video>
                                        @else
                                            <div class="icon-area icon-area-mp3">
                                                <i class="fas fa-music" style="color: #15aabf"></i>
                                            </div>
                                        @endif
                                        <div class="song-details">
                                            <p class="name">{{ $file->name }}</p>
                                            <p class="artist"></p>
                                        </div>
                                        <div class="progress-area progress-area{{ $file->id }}">
                                            <div class="progress-bar">
                                                @if ($file->type == 'mp3')
                                                    <audio id="main-audio{{ $file->id }}" src={{ $file->link }}
                                                        type="audio/mpeg"></audio>
                                                @else
                                                    {{-- <video id="main-audio{{ $file->id }}"
                                                                src={{ $file->link }}></video> --}}
                                                @endif
                                            </div>
                                            <div class="song-timer">
                                                <span class="current-time{{ $file->id }}">0:00</span>
                                                <span class="max-duration{{ $file->id }}">0:00</span>
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <a href="{{ $file->link }}" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a onclick="playMp3({{ $file->id }})"
                                                class="main-audio{{ $file->id }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                            <i class="fas fa-ellipsis-h" id="music-info{{ $file->id }}"></i>
                                        </div>
                                        <div class="music-info music-info{{ $file->id }}">
                                            <div class="header">
                                                <div class="row">
                                                    <i class="fas fa-music"></i>
                                                    <span>Music info</span>
                                                </div>
                                                <i id="close{{ $file->id }}" class="fas fa-times"></i>
                                            </div>
                                            <ul>
                                                <li>
                                                    <span><b> Name: </b></span> <span>{{ $file->name }}</span>
                                                </li>
                                                <li>
                                                    <span><b> Type: </b></span> <span>{{ $file->type }}</span>
                                                </li>
                                                <li>
                                                    <span><b> Size: </b></span> <span>{{ $file->size }}</span>
                                                </li>
                                                <li>
                                                    <span><b> Privacy: </b></span> <span>
                                                        @if ($file->privacy)
                                                            {{ $file->privacy }}
                                                        @else
                                                            Private
                                                        @endif
                                                    </span>
                                                </li>
                                                <li>
                                                    <span><b> Create At: </b></span>
                                                    <span>{{ $file->created_at }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Music Player End --}}
                    @endif
                    {{-- </div> --}}

                    {{-- Modal Rename File Start --}}
                    <div class="modal fade" id="file{{ $file->id }}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Rename</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/content-detail/{{ $file->id }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>New name</label>
                                            <input type="text" class="form-control" name="name" placeholder="New name">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Modal Rename File End --}}

                    @if ($file->privacy)
                        {{-- Modal File Path Start --}}
                        <div class="modal fade" id="file_path{{ $file->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">File Path</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="text" id="path-{{ $file->id }}"
                                                class="form-control col-sm-9 mr-2" value="{{ $file->link }}">
                                            <button type="button" class="ml-2 btn btn-secondary col-sm-2"
                                                onclick="coppyPath({{ $file->id }})">Copy Path</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal File Path End --}}
                    @endif
                @endforeach
            </div>
        </div>

    </div>
    </div>

@endsection
@push('content')
    <!-- Ekko Lightbox -->
    <script src={{ URL::asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}></script>
    <!-- SweetAlert2 -->
    <script src={{ URL::asset('plugins/sweetalert2/sweetalert2.min.js') }}></script>
    {{-- Music Player --}}
    <script src={{ URL::asset('js/music-player.js') }}></script>
    {{-- Dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    <script src={{ URL::asset('js/dropzone-post.js') }}></script>
    <script>
        $(document).ready(function() {
            $(function() {
                // Multiple images preview with JavaScript
                var multiImgPreview = function(input, imgPreviewPlaceholder) {
                    if (input.files) {
                        var filesAmount = input.files;
                        for (i = 0; i < filesAmount.length; i++) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $($.parseHTML('<img>')).attr('src', e.target.result).appendTo(
                                    imgPreviewPlaceholder);
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };

                $('#images').on('change', function() {
                    multiImgPreview(this, 'div.imgPreview');
                });
            });

            $("#list").click(() => {
                // $(".media-item").css("display", "inline-block");
                $(".media-item").removeClass("media-grid media-grid-mp3");
                $(".media-item .file-img").css("min-height", "0px");
                $(".media-item").addClass("media-list mt-2");
                $(".media-item-mp3").addClass("media-list");
                $(".media-content").addClass("hidden");
                $(".media-content-mp3").addClass("hidden");
                $(".file-name").css("display", "inline-block");
                $(".file-img").css("display", "inline-block");
                $(".media-item img").css("display", "none");
                $(".file-icon").css("display", "inline-block");
            });

            $("#icons").click(() => {
                $(".media-item").removeClass("media-list");
                $(".media-item-mp3").removeClass("media-list");
                $(".media-content").removeClass("hidden");
                $(".media-content-mp3").removeClass("hidden");
                $(".media-item").addClass("media-grid");
                $(".media-item-mp3").addClass("media-grid-mp3");
                $(".media-item .file-img").css("min-height", "250px");
                $(".file-name").css("display", "none");
                $(".file-img").css("display", "none");
                $(".media-item img").css("display", "block");
                $(".file-icon").css("display", "none");
            });
        });

        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endpush
