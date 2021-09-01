@extends('layouts.master')
<!-- Title content -->
@section('title')
    Quản lý tài sản
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-up')
    {{-- CSS Table --}}
    <link rel="stylesheet" href={{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <!-- Select2 -->
    <link rel="stylesheet" href={{ URL::asset('plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
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
                    <h1>Quản lý tài sản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @can('create_assets', User::class)
                            <li class="btn-file-custom"><a href="#" class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                            </li>

                            <li class="btn-file- "><a href="#" class="btn bg-gradient-success btn-sm" data-toggle="modal"
                                    data-target="#addAsset">Thêm mới</a></li>
                        @endcan
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    

    <div class="modal fade" id="addAsset">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm tài sản</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  method="POST" action={{route('assets.store')}} enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row my-3">
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Mã tài sản</label>
                                <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Mã tài sản">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Tên tài sản</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Phân loại</label>
                                <select id="" name="property_type_id" class="form-control select2bs4" style="width: 100%;">
                                    <option value="1" selected="selected">Phân loại</option>
                                    @foreach ($property_types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
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
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Trạng thái</label>
                                <select id="" name="usage_status" class="form-control select2bs4" style="width: 100%;">
                                    <option value="Tốt" selected="selected">Tốt</option>
                                    <option value="Trung bình">Trung bình</option>
                                    <option value="Hỏng">Hỏng</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Nhà cung cấp</label>
                                <select id="" name="provide_id" class="form-control select2bs4" style="width: 100%;">
                                        <option value="1" selected="selected">Nhà cung cấp</option>
                                        @foreach ($provides as $provide)
                                            <option value="{{$provide->id}}">{{$provide->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Ngày mua</label>
                                <input type="date" name="date_purchase" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Ngày hết bảo hành</label>
                                <input type="date" name="warranty_expires" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Ngày thanh lý</label>
                                <input type="date" name="date_liquidation" class="form-control" id="exampleInputEmail1">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Giá trị ban đầu</label>
                                <input type="number" name="first_value" class="form-control" id="exampleInputEmail1" placeholder="Giá trị ban đầu" >
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Tỉ lệ khấu hao hàng năm</label>
                                <input type="number" name="depreciation_per_year" class="form-control" id="exampleInputEmail1" placeholder="Tỉ lệ khấu hao hàng năm" >
                            </div>
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Phòng ban quản lý</label>
                                <select id="" name="department_id" class="form-control select2bs4" style="width: 100%;">
                                    <option value="1" selected="selected">Phòng ban quản lý</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="row my-3">
                            <div class="form-group col-sm-4">
                                <label for="customFile">Chọn files</label>
                                <div class="custom-file">
                                    <input type="file" name="files[]" class="custom-file-input" id="customFile" multiple="multiple">
                                    <label class="custom-file-label" for="customFile">Chọn files</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <label>Ghi chú</label>
                            <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ..."></textarea>
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
    <!-- /.modal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group row">
                            <label for="inputName" class="col-1 col-form-label">Chi nhánh</label>
                            <div class="col-3">
                                <select id="select_branch" class="form-control select2bs4" style="width: 100%;">
                                    <option value="0" selected="selected">Tất cả chi nhánh</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mã tài sản</th>
                                    <th>Tên tài sản</th>
                                    <th>Loại</th>
                                    <th>Nhóm</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày mua</th>
                                    <th>Ngày hết BH</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_assets">
                                @foreach ($assets as $asset)
                                <tr>
                                    <td> {{$asset->code}}</td>
                                    <td> {{$asset->name }}</td>
                                    <td> {{$asset->property_type->name}}</td>
                                    <td> {{$asset->property_group->name}}</td>
                                    <td> {{$asset->usage_status}}</td>
                                    <td> {{$asset->date_purchase}}</td>
                                    <td> {{$asset->date_liquidation}}</td>
                                    <td>
                                        <div class="row">
                                            @can('update_assets', User::class)
                                                <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                style="margin-left: 2px"
                                                    data-toggle="modal" data-target="#editAsset{{$asset->id}}">Sửa</button>
                                            @endcan
                                            @can('view_assets', User::class)
                                                <a type="button" class="col-4 btn bg-gradient-primary btn-sm"
                                                style="margin-left: 2px" href="{{ route('assets.show', $asset->id) }}">Xem</a>
                                            @endcan
                                            @can('delete_assets', User::class)
                                                <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                    style="margin-left: 2px" data-toggle="modal"
                                                    data-target="#deleteAsset{{$asset->id}}">xóa</button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>


                                {{-- Modal Edit User Start --}}
                                <div class="modal fade" id="editAsset{{ $asset->id }}">
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
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                {{-- Modal Edit User End --}}



                                {{-- Modal Lock/Unlock User Start --}}
                                <div class="modal fade" id="deleteAsset{{ $asset->id}}">
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
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                {{-- Modal Lock/Unlock User End --}}
                                @endforeach
                             
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
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
                $('#tbl_assets').find('tr').remove();
                // AJAX request 
                $.ajax({
                    url: 'get-assets/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        var len = 0;
                        if (res != null) {
                            len = res.length;
                        }

                        if (len > 0) {
                            // Read data and create <tr>
                            for (var i = 0; i < len; i++) {
                                var row = `<tr>
                                    <td>${res[i].code}</td>
                                    <td>${res[i].name}</td>
                                    <td>${res[i].property_type_name}</td>
                                    <td>${res[i].property_group_name}</td>
                                    <td>${res[i].usage_status}</td>
                                    <td>${res[i].date_purchase}</td>
                                    <td>${res[i].date_liquidation}</td>
                                    <td>
                                        <div class="row">
                                            @can('update_assets', User::class)
                                                <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                style="margin-left: 2px"
                                                    data-toggle="modal" data-target="#editAsset${res[i].id}">Sửa</button>
                                            @endcan
                                            @can('view_assets', User::class)
                                                <a type="button" class="col-4 btn bg-gradient-primary btn-sm"
                                                style="margin-left: 2px" href="/assets/${res[i].id}">Xem</a>
                                            @endcan
                                            @can('delete_assets', User::class)
                                                <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                    style="margin-left: 2px" data-toggle="modal"
                                                    data-target="#deleteAsset${res[i].id}">xóa</button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>`;
                                $("#tbl_assets").append(row);
                            }
                        }
                    }
                });
            });
        });
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
<!-- End js -->
<!-- End Js -->
