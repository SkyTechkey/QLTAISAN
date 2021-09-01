@extends('layouts.master')
<!-- Title content -->
@section('title')
    Nhà cung cấp
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-up')
    <link rel="stylesheet" href={{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
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
                    <h1>Nhà cung cấp</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="btn-file-custom"><a href="#" class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                        </li>
                        @can('create_provide', App\Models\User::class)
                            <li class="btn-file-custom"><a href="#" class="btn bg-gradient-success btn-sm" data-toggle="modal"
                                    data-target="#addProvide">Thêm mới</a></li>

                        @endcan
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    

    <div class="modal fade" id="addProvide">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm nhà cung cấp</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action={{ route('provide.store') }}>
                    @csrf
                    <div style="padding: 20px 20px 0 20px;">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Tên nhà cung cấp</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputName"
                                    placeholder="Tên nhà cung cấp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-sm-2 col-form-label">Mã NCC</label>
                            <div class="col-sm-10">
                                <input type="text" name="code" class="form-control" id="code" placeholder="Mã nhà cung cấp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="số điện thoại">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" id="address" placeholder="địa chỉ">
                            </div>
                        </div>
                        <input type="text" hidden name="unit_id" value="1">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="container-fluid">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mã NCC</th>
                                    <th>Tên NCC</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>    
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($provide as $provide)
                                    <tr>
                                        {{-- <td>{{$provide->id}}</td> --}}
                                        <td>{{ $provide->code }}</td>
                                        <td>{{ $provide->name }}</td>
                                        <td>{{ $provide->address }}</td>
                                        <td>{{ $provide->phone }}</td>
                                        <td>
                                            <div class="row">
                                                @can('update_provide', App\Models\User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal"
                                                        data-target="#editProvide{{ $provide->id }}">Sửa</a>
                                                @endcan
                                                @can('delete_provide', App\Models\User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-danger btn-sm"
                                                        style="margin-left: 10px" data-toggle="modal"
                                                        data-target="#deleteProvide{{ $provide->id }}">Xóa</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Delete provide Start --}}
                                    <div class="modal fade" id="deleteProvide{{ $provide->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <form method="POST" action={{ route('provide.destroy', $provide->id) }}>
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Xác nhận xóa {{ $provide->name }}?</h4>
                                                        {{-- Thay tên chi nhánh vào ... --}}
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
                                    {{-- Modal Delete Provide End --}}

                                    {{-- Modal Edit Provide Start --}}
                                    <div class="modal fade" id="editProvide{{ $provide->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Sửa nhà cung cấp </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action={{ route('provide.update', $provide->id) }}>
                                                    @method('put')
                                                    @csrf
                                                    <div style="padding: 20px 20px 0 20px;">
                                                        <div class="form-group row">
                                                            <label for="inputName"
                                                                class="col-sm-2 col-form-label">Tên</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control"
                                                                    id="inputName" placeholder="Tên nhà cung cấp"
                                                                    value="{{ $provide->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="code" class="col-sm-2 col-form-label">Code
                                                                NCC</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="code" class="form-control"
                                                                    id="code" placeholder="mã nhà cung cấp"
                                                                    value="{{ $provide->code }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone" class="col-sm-2 col-form-label">Số điện
                                                                thoại</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="phone" class="form-control"
                                                                    id="phone" placeholder="số điện thoại"
                                                                    value="{{ $provide->phone }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="address" class="col-sm-2 col-form-label">Địa
                                                                chỉ</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="address" class="form-control"
                                                                    id="address" placeholder="địa chỉ"
                                                                    value="{{ $provide->address }}">
                                                            </div>
                                                        </div>
                                                        <input type="text" hidden name="unit_id" value="1">
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
                                    {{-- Modal Edit Provide End --}}
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
        });
    </script>
@endpush
<!-- End js -->
<!-- End Js -->
