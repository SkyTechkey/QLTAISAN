@extends('layouts.master')
<!-- Title content -->
@section('title')
    Quản lý phòng ban
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
                    <h1>Quản lý phòng ban</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="btn-file-custom"><a href="#" class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                        </li>
                        @can('create_department', App\Models\User::class)
                            <li class="btn-file- "><a href="#" class="btn bg-gradient-success btn-sm" data-toggle="modal"
                                data-target="#addDepartment">Thêm mới</a></li>
                        @endcan
                       
                    </ol>
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
            {{ Session::get('fail')}}
        </span>
    @endif

    <div class="modal fade" id="addDepartment">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm phòng ban</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('department.store') }}">
                    @csrf
                    <div style="padding: 20px 20px 0 20px;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="department_code">Department Code</label>
                                <input type="text" class="form-control" id="department_code" name='department_code'
                                    placeholder="department_code">
                            </div>
                            <div class="form-group">
                                <label for="name">Name Department</label>
                                <input type="text" class="form-control" id="name" name='name' placeholder="name">
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" rows="3" name="note" placeholder="Note ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" id="branch_id" name="branch_id">
                                    @foreach ($branches as $branch)
                                        <option value={{ $branch->id }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
                                    <th>Mã</th>
                                    <th>Tên phòng ban</th>
                                    <th>Note</th>
                                    <th>Nhân viên</th>
                                    <th>Chi nhánh</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_department">
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->department_code }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->note }}</td>
                                        <td>{{ count($department->user) }}</td>
                                        <td>{{ $department->branch->name }}</td>
                                        <td>
                                            <div class="row">
                                                @can('update_department', App\Models\User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal"
                                                        data-target="#editDepartment{{ $department->id }}">Sửa</a>
                                                @endcan
                                                @can('delete_department', App\Models\User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-danger btn-sm"
                                                    style="margin-left: 10px" data-toggle="modal"
                                                    data-target="#deleteDepartment{{ $department->id }}">Xóa</a>
                                                @endcan
                                                
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Delete Department Start --}}
                                    <div class="modal fade" id="deleteDepartment{{ $department->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xác nhận xóa phòng
                                                        {{ $department->name }}?</h4> {{-- Thay tên phòng ban vào ... --}}
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST"
                                                    action={{ route('department.destroy', $department->id) }}>
                                                    @method('delete')
                                                    @csrf

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
                                    {{-- Modal Delete Department End --}}

                                    {{-- Modal Edit Department Start --}}
                                    <div class="modal fade" id="editDepartment{{ $department->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Sửa phòng ban</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('department.update', $department->id) }}">
                                                    @csrf
                                                    @method('put')
                                                    <div style="padding: 20px 20px 0 20px;">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="department_code{{ $department->id }}">Department Code</label>
                                                                <input type="text" class="form-control" id="department_code{{ $department->id }}"
                                                                    name='department_code' placeholder="department_code"
                                                                    value="{{ $department->department_code }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name{{ $department->id }}">Name Department</label>
                                                                <input type="text" class="form-control" id="name{{ $department->id }}"
                                                                    name='name' placeholder="name"
                                                                    value="{{ $department->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Note</label>
                                                                <textarea class="form-control" rows="3" name="note"
                                                                    placeholder="Note ...">{{ $department->note }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="branch_id{{ $department->id }}">Branch</label>
                                                                <select class="custom-select" id="branch_id{{ $department->id }}"
                                                                    name="branch_id">
                                                                    @foreach ($branches as $branch)
                                                                        <option value={{ $branch->id }}
                                                                            {{ $department->branch_id == $branch->id ? 'selected' : '' }}>
                                                                            {{ $branch->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Hủy</button>
                                                                <button type="submit" class="btn btn-primary">Sửa</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    {{-- Modal Edit Department End --}}
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
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["excel", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
                $('#tbl_department').find('tr').remove();
                // AJAX request 
                $.ajax({
                    url: 'get-department/' + id,
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
                                        <td>${res[i].department_code}</td>
                                        <td>${res[i].name}</td>
                                        <td>${res[i].note ? res[i].note : ""}</td>
                                        <td>${res[i].numOfUser}</td>
                                        <td>${res[i].branch_name}</td>
                                        <td>
                                            <div class="row">
                                                <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal"
                                                    data-target="#editDepartment${res[i].id}">Sửa</a>
                                                <a href="#" class="col-5 btn bg-gradient-danger btn-sm"
                                                    style="margin-left: 10px" data-toggle="modal"
                                                    data-target="#deleteDepartment${res[i].id}">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>`;
                                $("#tbl_department").append(row);
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
