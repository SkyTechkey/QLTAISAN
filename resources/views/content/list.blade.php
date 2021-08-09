@extends('layouts.index')
@push('page_css')
    <link rel="stylesheet" href={{ URL::asset('css/media-folder.css') }}>
@endpush
@section('content')
    {{-- <div class="content-wrapper"> --}}
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body">
                <div>

                    <div class="mb-2">
                        <div class="float-left">
                            <a class="btn btn-secondary" href="javascript:void(0)" data-toggle="modal"
                                data-target="#newFolder">
                                New Folder </a>
                        </div>
                        <div>
                            <form action="/search-folder" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row pl-3">
                                    <label for="searchInfo" class="col-form-label">Content</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="searchInfo" name="searchInfo" placeholder="Search...">
                                    </div>
                                    <label for="fdate" class="col-form-label">From</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="fdate" id="fdate">
                                    </div>
                                    <label for="ldate" class="col-form-label">To</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="ldate" id="ldate">
                                    </div>
                                    <input hidden class="form-control" name="type_id" value={{ $type_id }}>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <div class="btn-group ml-2">
                                        <a id="list" class="btn btn-default" href="javascript:void(0)"> List view </a>
                                        <a id="icons" class="btn btn-default" href="javascript:void(0)"> Grid view </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="newFolder">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">New Folder</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/content" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label>Folder Name</label>
                                            <input type="text" class="form-control" name="folderName"
                                                placeholder="Folder name">
                                        </div>
                                        <input type="hidden" class="form-control" name="type_id" placeholder="Folder name"
                                            value={{ $type_id }}>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media">
                    <div class="p-0 row">
                        @foreach ($contents as $folder)
                            <a href="/content-detail/{{ $folder->id }}">
                                <div class="media-item media-grid">
                                    <i class="fas fa-folder mr-2 file-icon" style="display: none; color: #82c91e"></i>
                                    <span class="file-name" style="display: none">{{ $folder->title }}</span>
                                    <div class="media-content">
                                        <div>
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div class="p-2 large">
                                            <div style="color: #000">{{ $folder->title }}</div>
                                            <div class="text-muted fs-12">{{$folder->detail_content->count()}} item(s) {{ $folder->created_at->format('d-m-Y')}} </div>
                                            <div class="text-muted fs-12">Author: {{$folder->user->name}}</div>
                                        </div>
                                    </div>
                                    <div class="dropdown dropdown-media">
                                        <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="/content/{{ $folder->id }}" method="POST">
                                                <div class="row">
                                                    <div class="col text-end">
                                                        <button type="button" class="dropdown-item">Details</button>
                                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#folder{{ $folder->id }}">
                                                            Rename
                                                        </button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="folder{{ $folder->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Rename</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/content/{{ $folder->id }}" method="post"
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
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                        {{-- contextmenu start --}}
                        {{-- contextmenu end --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
@push('content')
    {{-- <script src={{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script> --}}


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
                $(".media-item").removeClass("media-grid");
                $(".media-item .file-img").css("min-height", "0px");
                $(".media-item").addClass("media-list");
                $(".media-content").addClass("hidden");
                $(".file-name").css("display", "inline-block");
                $(".media-item img").css("display", "none");
                $(".file-name-grid").css("display", "none");
                $(".media-item .file-icon").css("display", "inline-block");
            });

            $("#icons").click(() => {
                $(".media-item").removeClass("media-list");
                $(".media-content").removeClass("hidden");
                $(".media-item").addClass("media-grid");
                $(".media-item .file-img").css("min-height", "250px");
                $(".file-name").css("display", "none");
                $(".media-item img").css("display", "block");
                $(".file-name-grid").css("display", "block");
                $(".media-item .file-icon").css("display", "none");
            });
        });
    </script>
@endpush
