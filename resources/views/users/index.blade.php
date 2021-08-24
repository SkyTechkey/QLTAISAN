@extends('layouts.master')
<!-- Title content -->
@section('title')
    Quản lý nhân viên
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
                    <h1>Quản lý nhân viên</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="btn-file-custom"><a href="#" class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                        </li>
                        <li class="btn-file- "><a href="#" class="btn bg-gradient-success btn-sm" data-toggle="modal"
                                data-target="#addUser">Thêm mới</a></li>
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
    @if (Session::get('fail'))
        <span class="d-block alert alert-danger text-center">
            {{ Session::get('fail') }}
        </span>
    @endif

    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm nhân viên</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="/user" enctype="multipart/form-data">
                    @csrf
                    <div style="padding: 20px 20px 0 20px;">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Họ và tên</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" id="password" name="password"
                                    placeholder="Mật khẩu" required />
                            </div>
                        </div>
                    </div>
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
                                {{-- <select class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Username</th>
                                    <th>Tên phòng ban</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi Chú</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)

                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->department_id }}</td>
                                        <td>{{ $user->status ? 'active':'lock'}} </td>
                                        <td>{{ $user->note }}</td>
                                        <td>
                                            <div class="row">

                                                @can('update_user', User::class)
                                                <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal"
                                                data-target="#editUser{{ $user->id }}">Sửa</a>
                                                @endcan
                                                
                                                @can('delete_user', User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-danger btn-sm"
                                                    style="margin-left: 10px" data-toggle="modal"
                                                    data-target="#lockUser{{ $user->id }}">Khóa</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                                    @can('update_user', User::class)
                                        {{-- Modal Edit User Start --}}
                                        <div class="modal fade" id="editUser{{ $user->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Sửa nhân viên</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="form-horizontal">
                                                        <div style="padding: 20px 20px 0 20px;">
                                                            <div class="form-group row">
                                                                <label for="inputName" class="col-sm-2 col-form-label">Tên nhân
                                                                    viên</label>
                                                                <div class="col-sm-10">
                                                                    <input type="email" class="form-control" id="inputName"
                                                                        placeholder="Tên nhân viên" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputExperience" class="col-sm-2 col-form-label">Ghi
                                                                    chú</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" id="inputExperience"
                                                                        placeholder="Ghi chú"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        {{-- Modal Edit User End --}}
                                    @endcan

                                    @can('delete_user', User::class)
                                        {{-- Modal Lock/Unlock User Start --}}
                                        <div class="modal fade" id="lockUser{{ $user->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <form action="">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Bạn có thực sự muốn khóa tài khoản nhân viên {{ $user->name }} ( {{ $user->username }} )?</h4> {{-- Thay tên nhân viên vào ... --}}
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-light"
                                                                data-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-outline-light">Khóa</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        {{-- Modal Lock/Unlock User End --}}
                                    @endcan
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
    </script>
@endpush
<!-- End js -->
<!-- End Js -->
