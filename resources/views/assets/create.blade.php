@extends('layouts.master')
<!-- Title content -->
@section('title')
    Quản lý tài sản
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
                    <h1>Thêm chi tiết tài sản</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form  method="POST" action={{route('assets.store')}} enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-sm-4">
                                    <input type="number" name="detail_id" value={{$detail_id}} class="form-control" id="exampleInputEmail1" hidden>
                                    <input type="text" name="detail_type" value="{{$detail_type}}" class="form-control" id="exampleInputEmail1" hidden>
                                </div>
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
