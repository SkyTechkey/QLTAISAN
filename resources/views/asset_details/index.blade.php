@extends('layouts.master')
<!-- Title content -->
@section('title')
    Chi tiết tài sản
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-up')
    {{-- CSS Table --}}
    <link rel="stylesheet"
          href={{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet"
          href={{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <!-- Select2 -->
    <link rel="stylesheet"
          href={{ URL::asset('plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet"
          href={{ URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
    <style>
        .btn-file-custom {
            margin: 0 5px;
        }

        .custom-img-tbl {
            height: 60px;
            width: 60px;
            object-fit: cover;
        }

    </style>
@endpush
<!-- End Css -->

<!--Add js -->
@push('js-up')

@endpush
<!-- End js -->

<!-- Body content -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết tài sản</h1>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs"
                                    id="custom-tabs-three-tab"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                           id="custom-tabs-three-home-tab"
                                           data-toggle="pill"
                                           href="#custom-tabs-three-home"
                                           role="tab"
                                           aria-controls="custom-tabs-three-home"
                                           aria-selected="true">Chi tiết Tài sản</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           id="custom-tabs-three-messages-tab"
                                           data-toggle="pill"
                                           href="#custom-tabs-three-messages"
                                           role="tab"
                                           aria-controls="custom-tabs-three-messages"
                                           aria-selected="false">Sửa chữa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           id="custom-tabs-three-messages-tab"
                                           data-toggle="pill"
                                           href="#files"
                                           role="tab"
                                           aria-controls="files"
                                           aria-selected="false">Files</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content"
                                     id="custom-tabs-three-tabContent">
                                     {{-- Tag tài sản --}}
                                    <div class="tab-pane fade show active"
                                         id="custom-tabs-three-home"
                                         role="tabpanel"
                                         aria-labelledby="custom-tabs-three-home-tab">
                                        <div>
                                            <ol class="breadcrumb">
                                                @can('create_assets', User::class)
                                                    <li class="btn-file-custom"><a href="#"
                                                           class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                                                    </li>

                                                    <li class="btn-file- "><a href="#"
                                                           class="btn bg-gradient-success btn-sm"
                                                           data-toggle="modal"
                                                           data-target="#addAssetDetails">Thêm mới</a></li>
                                                @endcan
                                            </ol>
                                        </div>
                                        <div>

                                            <table id="example1"
                                                   class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Tên phụ kiện</th>
                                                        <th>Giá trị</th>
                                                        <th>Thông tin kỹ thuật</th>
                                                        <th>Chức năng</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_assets">
                                                    @foreach ($assets_details as $asset_details)
                                                        <tr>
                                                            <td> {{ $asset_details->accessory_name }}</td>
                                                            <td> {{ $asset_details->value }}</td>
                                                            <td> {{ $asset_details->tech_info }}</td>
                                                            <td>
                                                         <div class="row">
                                                             @can('update_assets', User::class)
                                                                 <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                                 style="margin-left: 2px"
                                                                     data-toggle="modal" data-target="#editDetailAsset{{$asset_details->id}}">Sửa</button>
                                                             @endcan
                                                             @can('delete_assets', User::class)
                                                                 <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                     style="margin-left: 2px" data-toggle="modal"
                                                                     data-target="#deleteAsset{{$asset_details->id}}">xóa</button>
                                                             @endcan
                                                         </div>
                                                     </td>
                                                        </tr>
                                                        {{-- MODAL ADD CHI TIẾT TÀI SẢN --}}
                                                        <div class="modal fade" id="editDetailAsset{{$asset_details->id}}">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Thêm chi tiết tài sản</h4>
                                                                        <button type="button"
                                                                                class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form method="POST"
                                                                            action={{route('assets-detail.update',$asset_details->id) }}
                                                                            enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('put')
                                                                        <div class="card-body">
                                                                            <div class="row my-3">
                                                                                <div class="form-group col-sm-4">
                                                                                    <label for="assets">Tài sản</label>
                                                                                    <input type="text"
                                                                                            class="form-control"
                                                                                            id="assets"
                                                                                            value="{{ $asset_id }}"
                                                                                            disabled>
                                                                                    <input type="text"
                                                                                            name="assets"
                                                                                            class="form-control"
                                                                                            value="{{ $asset_id }}"
                                                                                            hidden>
                                                                                </div>
                                                                                <div class="form-group col-sm-4">
                                                                                    <label for="name">Tên thành phần</label>
                                                                                    <input type="text"
                                                                                            name="name"
                                                                                            class="form-control"
                                                                                            id="name"
                                                                                            value="{{$asset_details->accessory_name}}"
                                                                                            placeholder="Tên thành phần"
                                                                                            required>
                                                                                </div>
                                                                                <div class="form-group col-sm-4">
                                                                                    <label for="value">Giá trị</label>
                                                                                    <input type="number"
                                                                                            name="value"
                                                                                            class="form-control"
                                                                                            id="value"
                                                                                            placeholder="Giá trị"
                                                                                            value="{{$asset_details->value}}"
                                                                                            required>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div class="form-group my-3">
                                                                                    <label>Thông tin kỹ thuật</label>
                                                                                    <textarea class="form-control"
                                                                                                name="tech_info"
                                                                                                rows="4"
                                                                                                placeholder="Ghi chú ..."
                                                                                                required>{{$asset_details->tech_info}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">Sửa</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        {{-- MODAL ADD PHÍ SỬA CHỮA --}}

                                                       



                                                        <div class="modal fade" id="deleteAsset{{$asset_details->id}}">
                                                             <div class="modal-dialog">
                                                                 <div class="modal-content bg-danger">
                                                                     <form action="{{route('assets-detail.destroy',$asset_details->id)}}" method="POST">
                                                                         @csrf
                                                                         @method('DELETE')
                                                                         <div class="modal-header">
                                                                             <h4 class="modal-title">Xác nhận xóa?</h4>
                                                                             <button type="button" class="close" data-dismiss="modal"
                                                                                 aria-label="Close">
                                                                                 <span aria-hidden="true">&times;</span>
                                                                             </button>
                                                                         </div>
                                                                         <div class="modal-footer justify-content-between">
                                                                             <button type="button" class="btn btn-outline-light"
                                                                                 data-dismiss="modal">Hủy</button>
                                                                             <button type="submit" class="btn btn-outline-light">Xóa</button>
                                                                         </div>
                                                                     </form>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- Tag phiếu --}}
                                    <div class="tab-pane fade"
                                         id="custom-tabs-three-profile"
                                         role="tabpanel"
                                         aria-labelledby="custom-tabs-three-profile-tab">
                                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et
                                        vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis
                                        in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl
                                        ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at,
                                        posuere nec nunc. Nunc euismod pellentesque diam.
                                    </div>
                                    {{-- Tag sửa chữa --}}
                                    <div class="tab-pane fade"
                                         id="custom-tabs-three-messages"
                                         role="tabpanel"
                                         aria-labelledby="custom-tabs-three-messages-tab">
                                         <div>
                                            <ol class="breadcrumb">
                                                @can('create_assets', User::class)
                                                    <li class="btn-file-custom"><a href="#"
                                                           class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                                                    </li>

                                                    <li class="btn-file- "><a href="#"
                                                           class="btn bg-gradient-success btn-sm"
                                                           data-toggle="modal"
                                                           data-target="#addFee">Thêm mới</a></li>
                                                @endcan
                                            </ol>
                                        </div>
                                        <table id="example2"
                                               class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tài sản</th>
                                                    <th>Ngày sửa</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Chi phí (nghìn vnđ)</th>
                                                    <th>Chi tiết</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_repair_costs">
                                                @foreach ($repair_costs as $repair_cost)
                                                    <tr>
                                                        <td> {{ $repair_cost->asset_id }}</td>
                                                        <td> {{ $repair_cost->date }}</td>
                                                        <td> {{ $repair_cost->provide_id }}</td>
                                                        <td> {{ $repair_cost->cost }}</td>
                                                        <td> {{ $repair_cost->details }}</td>
                                                        <td>
                                                               <div class="row">
                                                                   @can('update_assets', User::class)
                                                                       <button type="button" class="col-4 btn bg-gradient-success btn-sm"
                                                                       style="margin-left: 2px"
                                                                           data-toggle="modal" data-target="#editFee{{$repair_cost->id}}">Sửa</button>
                                                                   @endcan
                                                                
                                                                   @can('delete_assets', User::class)
                                                                       <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                           style="margin-left: 2px" data-toggle="modal"
                                                                           data-target="#editFee{{$repair_cost->id}}">xóa</button>
                                                                   @endcan
                                                               </div>
                                                           </td>
                                                    </tr>

                                                    {{-- MODAL ADD PHÍ SỬA CHỮA --}}
                                                    <div class="modal fade" id="editFee{{$repair_cost->id}}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Sửa khoản phí</h4>
                                                                    <button type="button"
                                                                            class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form  method="POST" action={{route('assets-repair.update',$repair_cost->id)}} enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="card-body">
                                                                        <div class="row my-3">
                                                                        
                                                                                <div class="form-group col-sm-4">
                                                                                    <label for="assets">Tài sản</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="assets"
                                                                                        value="{{ $asset_id }}"
                                                                                        disabled>
                                                                                    <input type="text"
                                                                                        name="assets"
                                                                                        class="form-control"
                                                                                        value="{{ $asset_id }}"
                                                                                        hidden>
                                                                                </div>
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="date">Ngày sửa</label>
                                                                                <input type="date"
                                                                                    name="date"
                                                                                    class="form-control"
                                                                                    value="{{ $repair_cost->date }}"
                                                                                    placeholder="Ngày sửa"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="cost">Chi phí (nghìn vnđ)</label>
                                                                                <input type="number"
                                                                                    name="cost"
                                                                                    class="form-control"
                                                                                    id="cost"
                                                                                    value="{{ $repair_cost->cost }}"
                                                                                    placeholder="Chi phí"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="form-group my-3">
                                                                                <label>Chi tiết sửa chữa</label>
                                                                                <textarea class="form-control"
                                                                                        name="details"
                                                                                        rows="4"
                                                                                        placeholder="Chi tiết sửa chữa ..." required>{{ $repair_cost->details }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <div class="modal fade" id="deleteFee{{$repair_cost->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <form action="{{route('assets-repair.destroy',$repair_cost->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Xác nhận xóa?</h4>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-outline-light"
                                                                            data-dismiss="modal">Hủy</button>
                                                                        <button type="submit" class="btn btn-outline-light">Xóa</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- File Start --}}
                                    <div class="tab-pane fade"
                                    id="files"
                                    role="tabpanel"
                                    aria-labelledby="files-tab">
                                    <div>
                                        <ol class="breadcrumb">
                                            @can('create_assets', User::class)
                                                <li class="btn-file-custom"><a href="#"
                                                       class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                                                </li>

                                                <li class="btn-file- "><a href="#"
                                                    class="btn bg-gradient-success btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#addFiles">Thêm mới</a></li>
                                            @endcan
                                        </ol>
                                    </div>
                                    <table id="example3"
                                           class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tài sản</th>
                                                <th>Name</th>
                                                <th>File</th>
                                                <th>Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @foreach ($files as $file)
                                                <tr>
                                                    <td> {{ $file->asset_id }}</td>
                                                    <td>
                                                        {{ $file->name }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ $file->path }}" alt="" class="custom-img-tbl">
                                                    </td>
                                                    <td>
                                                           <div class="row">
                                                               {{-- @can('update_assets', User::class)
                                                                   <button type="button" class="col-4 btn bg-gradient-success btn-sm"
                                                                   style="margin-left: 2px"
                                                                       data-toggle="modal" data-target="#editFee{{$file->id}}">Sửa</button>
                                                               @endcan --}}
                                                            
                                                               @can('delete_assets', User::class)
                                                                   <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                       style="margin-left: 2px" data-toggle="modal"
                                                                       data-target="#deleteFile{{$file->id}}">xóa</button>
                                                               @endcan
                                                           </div>
                                                       </td>
                                                </tr>

                                                <div class="modal fade" id="deleteFile{{$file->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <form action="{{route('files-upload.destroy', $file->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Xác nhận xóa?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light"
                                                                        data-dismiss="modal">Hủy</button>
                                                                    <button type="submit" class="btn btn-outline-light">Xóa</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                               </div>
                                    {{-- File End --}}
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
            </div>
        </div>

        <div class="modal fade" id="addFiles">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm files</h4>
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action={{route('files-upload.store')}} enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row my-3">
                                    <div class="form-group col-sm-6">
                                        <label>Tài sản</label>
                                        <input type="text"
                                            class="form-control"
                                            value="{{ $asset_id }}"
                                            disabled>
                                        <input type="text"
                                            name="assets_id"
                                            class="form-control"
                                            value="{{ $asset_id }}"
                                            hidden>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="customFile">Chọn files</label>
                                        <div class="custom-file">
                                            <input type="file" name="files[]" class="custom-file-input" id="customFile" multiple="multiple">
                                            <label class="custom-file-label" for="customFile">Chọn files</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        {{-- MODAL ADD CHI TIẾT TÀI SẢN --}}
        <div class="modal fade"
             id="addAssetDetails">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm tài sản</h4>
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST"
                          action={{route('assets-detail.store') }}
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="form-group col-sm-4">
                                    <label for="assets">Tài sản</label>
                                    <input type="text"
                                           class="form-control"
                                           id="assets"
                                           value="{{ $asset_id }}"
                                           disabled>
                                    <input type="text"
                                           name="assets"
                                           class="form-control"
                                           value="{{ $asset_id }}"
                                           hidden>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="name">Tên thành phần</label>
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           id="name"
                                           placeholder="Tên thành phần"
                                           required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="value">Giá trị</label>
                                    <input type="number"
                                           name="value"
                                           class="form-control"
                                           id="value"
                                           placeholder="Giá trị"
                                           required>
                                </div>
                            </div>
                            <div>
                                <div class="form-group my-3">
                                    <label>Thông tin kỹ thuật</label>
                                    <textarea class="form-control"
                                              name="tech_info"
                                              rows="4"
                                              placeholder="Ghi chú ..."
                                              required></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button"
                                    class="btn btn-default"
                                    data-dismiss="modal">Close</button>
                            <button type="submit"
                                    class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- MODAL ADD PHÍ SỬA CHỮA --}}
        <div class="modal fade"
            id="addFee">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm khoản phí</h4>
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  method="POST" action={{route('assets-repair.store')}} enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row my-3">
                            
                                    <div class="form-group col-sm-4">
                                        <label for="assets">Tài sản</label>
                                        <input type="text"
                                            class="form-control"
                                            id="assets"
                                            value="{{ $asset_id }}"
                                            disabled>
                                        <input type="text"
                                            name="assets"
                                            class="form-control"
                                            value="{{ $asset_id }}"
                                            hidden>
                                    </div>
                                <div class="form-group col-sm-4">
                                    <label for="date">Ngày sửa</label>
                                    <input type="date"
                                        name="date"
                                        class="form-control"
                                        id="date"
                                        placeholder="Ngày sửa"
                                        required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="cost">Chi phí (nghìn vnđ)</label>
                                    <input type="number"
                                        name="cost"
                                        class="form-control"
                                        id="cost"
                                        placeholder="Chi phí"
                                        required>
                                </div>
                            </div>
                            <div>
                                <div class="form-group my-3">
                                    <label>Chi tiết sửa chữa</label>
                                    <textarea class="form-control"
                                            name="details"
                                            rows="4"
                                            placeholder="Chi tiết sửa chữa ..." required></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
        
    </div>

@endsection
<!-- End body-->

<!--Add Css -->
@push('css-down')

@endpush
<!-- End Css -->

<!--Add js -->
@push('js-down')
    {{-- JS table search --}}
    <script src={{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script>
    <script src={{ URL::asset('plugins/jszip/jszip.min.js') }}></script>
    <!-- Select2 -->
    <script src={{ URL::asset('plugins/select2/js/select2.full.min.js') }}></script>
    <!-- bs-custom-file-input -->
    <script src={{ URL::asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example3').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });

        $(document).ready(function() {
            // Branch Change
            $('#select_branch').change(function() {
                // Branch id
                var id = $(this).val();
                // Set Empty the table
                $('#tbl_user').find('tr').remove();
                // AJAX request 
                $.ajax({
                    url: 'get-user/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(res) {
                        var len = 0;
                        if (res != null) {
                            len = res.length;
                        }

                        if (len > 0) {
                            // Read data and create <tr>
                            for (var i = 0; i < len; i++) {
                                var row = `<tr>
                                        <td>${res[i].id}</td>
                                        <td>${res[i].name}</td>
                                        <td>${res[i].username}</td>
                                        <td>${res[i].department_name}</td>
                                        <td>${res[i].status ? "Active" : "Lock"}</td>
                                        <td>${res[i].note ? res[i].id : ""}</td>
                                        <td>
                                            <div class="row">
                                                @can('update_user', User::class)
                                                    <a href="#"
                                                       class="col-5 btn bg-gradient-success btn-sm"
                                                       data-toggle="modal"
                                                       data-target="#editUser${res[i].id}">Sửa</a>
                                                @endcan

                                                @can('delete_user', User::class)
                                                    <a href="#"
                                                       class="col-5 btn bg-gradient-danger btn-sm"
                                                       style="margin-left: 10px"
                                                       data-toggle="modal"
                                                       data-target="#lockUser${res[i].id}">${res[i].status ? "Khóa" : "Mở khóa"}</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>`;
                                $("#tbl_user").append(row);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
<!-- End js -->
<!-- End Js -->
