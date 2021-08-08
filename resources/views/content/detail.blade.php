@extends('layouts.index')
@push('page_css')
    <link rel="stylesheet" href={{ URL::asset('css/media-image.css') }}>
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href={{ URL::asset('plugins/ekko-lightbox/ekko-lightbox.css') }}>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href={{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- Music Player -->
    <link rel="stylesheet" href={{ URL::asset('css/music-player.css') }}>
@endpush
@section('content')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body">
                <div>
                    <div class="mb-2">
                        <div class="float-left">

                            <a class="btn btn-secondary" href="javascript:void(0)" data-toggle="modal"
                                data-target="#newFiles">
                                New Files </a>
                        </div>

                        <div>
                            <form action="/search-file" method="GET" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="searchInfo" class="col-form-label">Content</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="searchInfo" name="searchInfo"
                                            placeholder="Search...">
                                    </div>
                                    <label for="fdate" class="col-form-label">From</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="fdate" id="fdate">
                                    </div>
                                    <label for="ldate" class="col-form-label">To</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="ldate" id="ldate">
                                    </div>
                                    <input hidden class="form-control" name="content_id" value={{ $content_id }}>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <div class="btn-group ml-2">
                                        <a id="list" class="btn btn-default" href="javascript:void(0)"> List view </a>
                                        <a id="icons" class="btn btn-default" href="javascript:void(0)"> Grid view </a>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                        <form action="/content-detail" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @endif

                                            {{-- @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif --}}

                                            <input name="content_id" value="{{ $content_id }}" hidden>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea class="form-control" rows="3" name="note"
                                                    placeholder="Note..."></textarea>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="privacy" id="checkboxPrivacy">
                                                <label for="checkboxPrivacy">Public</label>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="imageFile[]" class="custom-file-input" id="images"
                                                    multiple="multiple">
                                                <label class="custom-file-label" for="images">Choose files</label>
                                            </div>


                                            <div class="user-image mb-3 text-center">
                                                <div class="imgPreview"></div>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload Files</button>
                                    </div>
                                    </form>
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
                                            <i class="fas fa-file-image mr-2 file-icon text-indigo"
                                                style="display: none"></i>
                                            <span class="file-name" style="display: none">{{ $file->name }}</span>
                                        </div>
                                        <div class="card media-content box-shadow">
                                            <div class="media-image">
                                                <img src={{ $file->link_thumbnail }} width="100%" alt="file" />
                                            </div>
                                            <div class="p-2 large">
                                                <div style="color: #000" class="media-name">{{ $file->name }}</div>
                                                <div class="text-muted fs-12">{{ $file->size }}</div>
                                                <div class="text-muted fs-12">{{ explode(' ', $file->created_at)[0] }}
                                                </div>
                                                @if ($file->privacy)
                                                    <span class="media-privacy">{{ $file->privacy }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown dropdown-media">
                                        <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="/content-detail/{{ $file->id }}" method="POST">
                                                <div class="row">
                                                    <div class="col text-end">
                                                        {{-- <button type="button" class="dropdown-item">Details</button> --}}
                                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#file{{ $file->id }}">
                                                            Rename
                                                        </button>
                                                        <a href="/content-detail/download/{{ $file->id }}"
                                                            class="dropdown-item">Download</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#play-music{{ $file->id }}">
                                    <div class="media-item-mp3 media-grid-mp3">
                                        @if ($file->type == 'mp3')
                                            <i class="fas fa-music mr-2 file-icon"
                                                style="display: none; color: #15aabf"></i>
                                        @else
                                            <i class="fas fa-film mr-2 file-icon" style="display: none; color: #f783ac"></i>
                                        @endif
                                        <span class="file-name" style="display: none">{{ $file->name }}</span>
                                        <div class="media-content-mp3">
                                            <div>
                                                @if ($file->type == 'mp3')
                                                    <i class="fas fa-music"></i>
                                                @else
                                                    <i class="fas fa-film" style="color: #f783ac"></i>
                                                @endif
                                            </div>
                                            <div class="p-2 large">
                                                <div style="color: #000" class="media-name">{{ $file->name }}</div>
                                                <div class="text-muted fs-12">{{ explode(' ', $file->created_at)[0] }}</div>
                                                <div class="text-muted fs-12">User: admin</div>
                                                @if ($file->privacy)
                                                    <span class="media-privacy">{{ $file->privacy }}</span>
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
                                                            {{-- <button type="button" class="dropdown-item">Details</button> --}}
                                                            <button type="button" class="dropdown-item" data-toggle="modal"
                                                                data-target="#file{{ $file->id }}">
                                                                Rename
                                                            </button>
                                                            <a href="/content-detail/download/{{ $file->id }}"
                                                                class="dropdown-item">Download</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">Delete</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                {{-- Modal Music Player Start --}}
                                <div class="modal fade" id="play-music{{ $file->id }}">
                                    <div class="modal-dialog modal-lg modal-mp3">
                                        <div class="modal-content">
                                            <div class="wrapper-mp3">
                                                <div class="icon-area">
                                                    <i class="fas fa-music" style="color: #15aabf"></i>
                                                </div>
                                                <div class="song-details">
                                                    <p class="name">{{ $file->name }}</p>
                                                    <p class="artist"></p>
                                                </div>
                                                <div class="progress-area progress-area{{ $file->id }}">
                                                    <div class="progress-bar">
                                                        @if($file->type == "mp3")
                                                            <audio id="main-audio{{ $file->id }}" src={{ $file->link }}
                                                                type="audio/mpeg"></audio>id="main-audio{{ $file->id }}"
                                                        @else
                                                            <video id="main-audio{{ $file->id }}" src=src={{ $file->link }} ></video> 
                                                        @endif
                                                    </div>
                                                    <div class="song-timer">
                                                        <span class="current-time{{ $file->id }}">0:00</span>
                                                        <span class="max-duration{{ $file->id }}">0:00</span>
                                                    </div>
                                                </div>
                                                <div class="controls">
                                                    <a href="{{ $file->link }}" download="">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <a onclick="playMp3({{$file->id}})"
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
                                                              <span><b> Privacy: </b></span> <span> @if ($file->privacy)
                                                                {{ $file->privacy }}
                                                              @else
                                                                  Private
                                                              @endif </span>
                                                        </li>
                                                        <li>
                                                              <span><b> Create At: </b></span> <span>{{ $file->created_at }}</span>
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
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="New name">
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    @endsection
    @push('content')
        <!-- Ekko Lightbox -->
        <script src={{ URL::asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}></script>
        {{-- Music Player --}}
        <script src={{ URL::asset('js/music-player.js') }}></script>
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
