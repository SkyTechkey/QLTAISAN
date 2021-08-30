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

    @if (Session::get('success'))
        <span class="d-block alert alert-success text-center">
            {{ Session::get('success') }}
        </span>
    @endif
    @if (Session::has('fail'))
        <span class="d-block alert alert-danger text-center">
            {{ Session::get('fail') }}
        </span>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-1 col-form-label">Chi nhánh</label>
                            <div class="col-3">
                                <select id="select_branch"
                                        class="form-control select2bs4"
                                        style="width: 100%;">
                                    <option value="0"
                                            selected="selected">Tất cả chi nhánh</option>
                                    {{-- @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                           aria-selected="true">Tài sản</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           id="custom-tabs-three-profile-tab"
                                           data-toggle="pill"
                                           href="#custom-tabs-three-profile"
                                           role="tab"
                                           aria-controls="custom-tabs-three-profile"
                                           aria-selected="false">Phiếu</a>
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
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content"
                                     id="custom-tabs-three-tabContent">
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
                                                        {{-- <th>Chức năng</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_assets">
                                                    @foreach ($assets_details as $asset_details)
                                                        <tr>
                                                            <td> {{ $asset_details->accessory_name }}</td>
                                                            <td> {{ $asset_details->value }}</td>
                                                            <td> {{ $asset_details->tech_info }}</td>
                                                            {{-- <td>
                                                         <div class="row">
                                                             @can('update_assets', User::class)
                                                                 <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                                 style="margin-left: 2px"
                                                                     data-toggle="modal" data-target="#editAsset{{$asset_details->id}}">Sửa</button>
                                                             @endcan
                                                             @can('view_assets', User::class)
                                                                 <a type="button" class="col-4 btn bg-gradient-primary btn-sm"
                                                                 style="margin-left: 2px" href="{{ route('assets.show', $asset_details->id) }}">Xem</a>
                                                             @endcan
                                                             @can('delete_assets', User::class)
                                                                 <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                     style="margin-left: 2px" data-toggle="modal"
                                                                     data-target="#deleteAsset{{$asset_details->id}}">xóa</button>
                                                             @endcan
                                                         </div>
                                                     </td> --}}
                                                        </tr>


                                                        {{-- Modal Edit User Start --}}
                                                        {{-- <div class="modal fade" id="editAsset{{ $asset_details->id }}">
                                                             <div class="modal-dialog modal-lg">
                                                                 <div class="modal-content">
                                                                     <div class="modal-header">
                                                                         <h4 class="modal-title">Sửa nhân viên</h4>
                                                                         <button type="button" class="close" data-dismiss="modal"
                                                                             aria-label="Close">
                                                                             <span aria-hidden="true">&times;</span>
                                                                         </button>
                                                                     </div>
                                                                     <form class="form-horizontal" method="post" action="{{route('assets.update',$asset->id)}}" enctype="multipart/form-data">
                                                                         @csrf
                                                                         @method('put')
                                                                         <div class="card-body">
                                                                             <div class="row my-3">
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Mã tài sản</label>
                                                                                     <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Mã tài sản"
                                                                                     value="{{$asset->code}}">
                                                                                 </div>
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Tên tài sản</label>
                                                                                     <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản"
                                                                                     value="{{$asset->name}}" >
                                                                                 </div>
                                                                                 <div class="col-sm-4">
                                                                                     <label for="exampleInputEmail1">Phân loại</label>
                                                                                     <select id="" name="property_type_id" class="form-control select2bs4" style="width: 100%;">
                                                                                         @foreach ($property_types as $type)
                                                                                             <option value="{{$type->id}}" 
                                                                                                 {{$type->id==$asset->property_type_id ? 'selected="selected"' : ''}}>{{$type->name}}</option>
                                                                                         @endforeach
                                                                                     </select>
                                                                                 </div>
                                                                             </div>
                                                         
                                                                             <div class="row my-3">
                                                                                 <div class="col-sm-4">
                                                                                     <label for="exampleInputEmail1">Nhóm tài sản</label>
                                                                                     <select id="" name="property_group_id" class="form-control select2bs4" style="width: 100%;">
                                                                                             <option value="1" selected="selected">Nhóm tài sản</option>
                                                                                             @foreach ($property_groups as $group)
                                                                                                 <option value="{{$group->id}}"
                                                                                                     {{$group->id==$asset->property_group_id ? 'selected="selected"' : ''}}>{{$group->name}}</option>
                                                                                             @endforeach
                                                                                     </select>
                                                                                 </div>
                                                                                 <div class="col-sm-4">
                                                                                     <label for="exampleInputEmail1">Trạng thái</label>
                                                                                     <select id="" name="usage_status" class="form-control select2bs4" style="width: 100%;">
                                                                                         <option value="Tốt" {{$asset->usage_status == 'Tốt'?'selected="selected"':''}}>Tốt</option>
                                                                                         <option value="Trung bình" {{$asset->usage_status == 'Trung bình'?'selected="selected"':''}}>Trung bình</option>
                                                                                         <option value="Hỏng" {{$asset->usage_status == 'Hỏng'?'selected="selected"':''}}>Hỏng</option>
                                                                                     </select>
                                                                                 </div>
                                                                                 <div class="col-sm-4">
                                                                                     <label for="exampleInputEmail1">Nhà cung cấp</label>
                                                                                     <select id="" name="provide_id" class="form-control select2bs4" style="width: 100%;">
                                                                                 
                                                                                             @foreach ($provides as $provide)
                                                                                                 <option value="{{$provide->id}}"
                                                                                                     {{$provide->id==$asset->provide_id ? 'selected="selected"' : ''}}>{{$provide->name}}</option>
                                                                                             @endforeach
                                                                                     </select>
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row my-3">
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Ngày mua</label>
                                                                                     <input type="date" name="date_purchase" class="form-control" id="exampleInputEmail1" value="{{$asset->date_purchase}}">
                                                                                 </div>
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Ngày hết bảo hành</label>
                                                                                     <input type="date" name="warranty_expires" class="form-control" id="exampleInputEmail1" value="{{$asset->warranty_expires}}">
                                                                                 </div>
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Ngày thanh lý</label>
                                                                                     <input type="date" name="date_liquidation" class="form-control" id="exampleInputEmail1" value="{{$asset->date_liquidation}}">
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row my-3">
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Giá trị ban đầu</label>
                                                                                     <input type="number" name="first_value" class="form-control" id="exampleInputEmail1" placeholder="Giá trị ban đầu"
                                                                                     value="{{$asset->first_value}}" >
                                                                                 </div>
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Tỉ lệ khấu hao hàng năm</label>
                                                                                     <input type="number" name="depreciation_per_year" class="form-control" id="exampleInputEmail1" placeholder="Tỉ lệ khấu hao hàng năm"
                                                                                     value="{{$asset->depreciation_per_year}}" >
                                                                                 </div>
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Giá trị khấu hao</label>
                                                                                     <input type="number" name="depreciation" class="form-control" id="exampleInputEmail1" placeholder="Giá trị khấu hao"
                                                                                     value="{{$asset->depreciation}}" >
                                                                                 </div>
                                                                             </div>
                                                                             <div class="row my-3">
                                                                                 <div class="form-group col-sm-4">
                                                                                     <label for="exampleInputEmail1">Giá trị còn lại</label>
                                                                                     <input type="number" name="residual_value" class="form-control" id="exampleInputEmail1" placeholder="Giá trị còn lại"
                                                                                     value="{{$asset->residual_value}}" >
                                                                                 </div>
                                                                                 <div class="col-sm-4">
                                                                                     <label for="exampleInputEmail1">Phòng ban quản lý</label>
                                                                                     <select id="" name="department_id" class="form-control select2bs4" style="width: 100%;">
                                                                                             @foreach ($departments as $department)
                                                                                                 <option value="{{$department->id}}"
                                                                                                     {{$department->id==$asset->department_id ? 'selected="selected"' : ''}}>{{$department->name}}</option>
                                                                                             @endforeach
                                                                                     </select>
                                                                                 </div>                                                                
                                                                             </div>
                                                                             <div class="form-group my-3">
                                                                                 <label>Ghi chú</label>
                                                                                 <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ...">{{$asset->note}}</textarea>
                                                                             </div>
                                                                         </div>
                                                                         <!-- /.card-body -->
                                                                         <div class="modal-footer justify-content-between">
                                                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                             <button type="submit" class="btn btn-primary">Thêm</button>
                                                                         </div>
                                                                     </form>
                                                                 </div> --}}
                                                        <!-- /.modal-content -->
                                                        {{-- </div> --}}
                                                        <!-- /.modal-dialog -->
                                                        {{-- </div> --}}
                                                        {{-- Modal Edit User End --}}



                                                        {{-- <div class="modal fade" id="deleteAsset{{ $asset->id}}">
                                                             <div class="modal-dialog">
                                                                 <div class="modal-content bg-danger">
                                                                     <form action="{{route('assets.destroy',$asset->id)}}" method="POST">
                                                                         @csrf
                                                                         @method('DELETE')
                                                                         <div class="modal-header">
                                                                             <h4 class="modal-title">Xác nhận xóa {{ $asset->name }}?</h4>
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
                                                         </div> --}}
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
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
                                    <div class="tab-pane fade"
                                         id="custom-tabs-three-messages"
                                         role="tabpanel"
                                         aria-labelledby="custom-tabs-three-messages-tab">
                                        <table id="example2"
                                               class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tài sản</th>
                                                    <th>Ngày sửa</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Chi phí (nghìn vnđ)</th>
                                                    <th>Chi tiết</th>
                                                    {{-- <th>Chức năng</th> --}}
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
                                                        {{-- <td>
                                                               <div class="row">
                                                                   @can('update_assets', User::class)
                                                                       <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                                       style="margin-left: 2px"
                                                                           data-toggle="modal" data-target="#editAsset{{$repair_cost->id}}">Sửa</button>
                                                                   @endcan
                                                                   @can('view_assets', User::class)
                                                                       <a type="button" class="col-4 btn bg-gradient-primary btn-sm"
                                                                       style="margin-left: 2px" href="{{ route('assets.show', $repair_cost->id) }}">Xem</a>
                                                                   @endcan
                                                                   @can('delete_assets', User::class)
                                                                       <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                           style="margin-left: 2px" data-toggle="modal"
                                                                           data-target="#deleteAsset{{$repair_cost->id}}">xóa</button>
                                                                   @endcan
                                                               </div>
                                                           </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
            </div>
        </div>

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
                          action={{ route('assets-details.store') }}
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
    <script>
        $(function() {
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
