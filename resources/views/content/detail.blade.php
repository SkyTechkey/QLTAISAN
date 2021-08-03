@extends('layouts.index')
@section('content')
    {{-- <div class="content-wrapper"> --}}
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body">
                <div>
                    <div class="mb-2">
                        <a class="btn btn-secondary" href="javascript:void(0)" data-toggle="modal" data-target="#newFiles">
                            New Files </a>


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

                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <input name="content_id" value="{{ $content_id }}" hidden>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Name">
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
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <div class="float-right">
                            <div class="btn-group">
                                <a id="list" class="btn btn-default" href="javascript:void(0)"> View by
                                    list </a>
                                <a id="icons" class="btn btn-default" href="javascript:void(0)"> View by
                                    icons </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media">
                    <div class="p-0 row">
                        @foreach ($contents as $file)
                            <div class="media-item mt-5 col-sm-2">
                                @if (in_array($file->type, ['jpeg', 'jpg', 'png', 'jfif']))
                                    <div class="file-img">
                                        <i class="fas fa-file-image mr-2 file-icon text-indigo" style="display: none"></i>
                                        <span class="file-name" style="display: none">{{ $file->name }}</span>
                                        <img src={{ $file->link_thumbnail }} class="img-fluid box-shadow" alt="file" />
                                    </div>
                                    <div class="p-2 large file-name-grid box-shadow">
                                        <div>{{ $file->name }}</div>
                                        <div class="text-muted">{{ $file->size }}</div>
                                    </div>
                                    <div class="dropdown position-absolute top-0 right-0 mr-3">
                                        <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="/content-detail/{{ $file->id }}" method="POST">
                                                <div class="row">
                                                    <div class="col text-end">
                                                        <button type="button" class="dropdown-item">Details</button>
                                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#file{{ $file->id }}">
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
                                    @elseif(in_array($file->type, ["csv", "xlsx"]))
                                        <i class="fas fa-file-excel text-success mr-2 file-icon" style="display: none"></i>
                                    @elseif($file->type=="txt")
                                        <i class="fas fa-file-alt text-secondary mr-2 file-icon" style="display: none"></i>

                                    @elseif($file->type=="pdf")
                                        <i class="fas fa-file-pdf text-danger mr-2 file-icon" style="display: none"></i>

                                    @elseif($file->type=="pptx")
                                        <i class="fas fa-file-powerpoint text-warning mr-2 file-icon"
                                            style="display: none"></i>

                                    @elseif($file->type=="docx")
                                        <i class="fas fa-file-word text-primary mr-2 file-icon" style="display: none"></i>
                                @endif
                                @if (!in_array($file->type, ['jpeg', 'jpg', 'png', 'jfif']))
                                    <span class="file-name" style="display: none">{{ $file->name }}</span>
                                    <div class="card app-file-list box-shadow">
                                        <div class="app-file-icon">
                                            @if (in_array($file->type, ['csv', 'xlsx']))
                                                <i class="fas fa-file-excel text-success"></i>
                                            @elseif($file->type=="txt")
                                                <i class="fas fa-file-alt text-secondary"></i>

                                            @elseif($file->type=="pdf")
                                                <i class="fas fa-file-pdf text-danger"></i>

                                            @elseif($file->type=="pptx")
                                                <i class="fas fa-file-powerpoint text-warning"></i>

                                            @elseif($file->type=="docx")
                                                <i class="fas fa-file-word text-primary"></i>
                                            @endif
                                            {{-- <i class="fas fa-folder text-danger"></i> --}}
                                        </div>
                                        <div class="p-2 large">
                                            <div style="color: #000">{{ $file->name }}</div>
                                            <div class="text-muted">{{ $file->size }}</div>
                                        </div>
                                    </div>
                                    <div class="dropdown position-absolute top-0 right-0 mr-3">
                                        <a href="#" class="btn btn-sm btn-hover" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="/content-detail/{{ $file->id }}" method="POST">
                                                <div class="row">
                                                    <div class="col text-end">
                                                        <button type="button" class="dropdown-item">Details</button>
                                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                            data-target="#file{{ $file->id }}">
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
                                @endif
                            
                        </div>

                        <div class="modal fade" id="file{{ $file->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Rename</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
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
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- </div> --}}
@endsection
@push('content')
    <script src={{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>

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
                $(".media-item").removeClass("col-sm-2");
                $(".media-item").removeClass("mt-5");
                $(".media-item .file-img").css("min-height", "0px");
                $(".media-item").addClass("col-sm-6");
                $(".media-item").addClass("mt-2");
                $(".media-item").addClass("media-item-hover");
                $(".app-file-list").addClass("hidden");
                $(".file-name").css("display", "inline-block");
                $(".media-item img").css("display", "none");
                $(".file-name-grid").css("display", "none");
                $(".media-item .file-icon").css("display", "inline-block");
            });

            $("#icons").click(() => {
                $(".media-item").removeClass("col-sm-6");
                $(".media-item").removeClass("mt-2");
                $(".media-item").removeClass("media-item-hover");
                $(".app-file-list").removeClass("hidden");
                $(".media-item").addClass("col-sm-2");
                $(".media-item").addClass("mt-5");
                $(".media-item .file-img").css("min-height", "250px");
                $(".file-name").css("display", "none");
                $(".media-item img").css("display", "block");
                $(".file-name-grid").css("display", "block");
                $(".media-item .file-icon").css("display", "none");
            });
        });
    </script>
@endpush
