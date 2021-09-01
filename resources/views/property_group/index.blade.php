@extends('layouts.master')
<!-- Title content -->
@section('title')
  Nhóm tài sản
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
                    <h1>Nhóm tài sản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="btn-file-custom"><a href="#" class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                        </li>
                        @can('create_property_group', App\Models\User::class)
                            <li class="btn-file-custom"><a href="#" class="btn bg-gradient-success btn-sm" data-toggle="modal"
                                    data-target="#addProperty_group">Thêm mới</a></li>

                        @endcan
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    

    <div class="modal fade" id="addProperty_group">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm nhóm tài sản</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action={{ route('property_group.store') }}>
                    @csrf
                    <div style="padding: 20px 20px 0 20px;">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nhóm tài sản</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputName"
                                    placeholder="Nhóm tài sản">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Mã nhóm tài sản <small>(3 - 4 kí tự)</small></label>
                            <div class="col-sm-10">
                                <input type="text" name="code" class="form-control" id="inputName"
                                    placeholder="Mã nhóm tài sản">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="note" class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <input type="text" name="note" class="form-control" id="note" placeholder="Ghi chú">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mã nhóm Tài sản</th>
                                    <th>Nhóm tài sản</th>
                                    <th>Ghi chú</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($property_group as $group)
                                    <tr>
                                        <td>{{ $group->code }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->note }}</td>
                                        <td>
                                            <div class="row">
                                                @can('update_property_group', App\Models\User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal"
                                                        data-target="#editProperty_group{{ $group->id }}">Sửa</a>
                                                @endcan
                                                @can('delete_property_group', App\Models\User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-danger btn-sm"
                                                        style="margin-left: 10px" data-toggle="modal"
                                                        data-target="#deleteProperty_group{{ $group->id }}">Xóa</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Delete property_group Start --}}
                                    <div class="modal fade" id="deleteProperty_group{{$group->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <form method="POST" action={{ route('property_group.destroy', $group->id) }}>
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Xác nhận xóa {{ $group->name }}?</h4>
                                                     
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
                                    {{-- Modal Delete property_groupe End --}}

                                    {{-- Modal Edit property_group Start --}}
                                    <div class="modal fade" id="editProperty_group{{ $group->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Sửa nhóm sản phẩm </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action={{ route('property_group.update',$group->id) }}>
                                                    @method('put')
                                                    @csrf
                                                    <div style="padding: 20px 20px 0 20px;">
                                                        <div class="form-group row">
                                                            <label for="inputName"
                                                                class="col-sm-2 col-form-label">Tên</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control"
                                                                    id="inputName" placeholder="Nhóm sản phẩm"
                                                                    value="{{$group->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-2 col-form-label">Mã nhóm tài sản <small>(3 - 4 kí tự)</small></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="code" class="form-control" id="inputName"
                                                                value="{{$group->code }}"
                                                                    placeholder="Mã nhóm tài sản">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-2 col-form-label">Ghi chú
                                                                </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="note" class="form-control"
                                                                    id="note" placeholder="ghi chú"
                                                                    value="{{$group->note }}">
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
                                    {{-- Modal Edit property_group End --}}
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