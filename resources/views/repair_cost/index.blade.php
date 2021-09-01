@extends('layouts.master')
<!-- Title content -->
@section('title')
    Quản lý chi phí sửa chữa
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
                    <h1>Quản lý chi phí sửa chữa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @can('create_assets', User::class)
                            <li class="btn-file-custom"><a href="#"
                                   class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                            </li>

                            <li class="btn-file- "><a href="#"
                                   class="btn bg-gradient-success btn-sm"
                                   data-toggle="modal"
                                   data-target="#addRepairCost">Thêm mới</a></li>
                        @endcan
                    </ol>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addRepairCost">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm tài sản</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  method="POST" action={{route('assets-repair.store')}} enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="col-sm-4">
                                    <label for="">Tài sản</label>
                                    <select id="" name="assets" class="form-control select2bs4" style="width: 100%;">
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                        @endforeach
                                    </select>
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
    </section>

    
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
                        <div class="tab-content"
                             id="custom-tabs-three-tabContent">
                            <table id="example1"
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
                                <tbody id="tbl_assets">
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
                                                                         value="{{ $repair_cost->asset_id}}"
                                                                         disabled>
                                                                     <input type="text"
                                                                         name="assets"
                                                                         class="form-control"
                                                                         value="{{ $repair_cost->asset_id}}"
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
                        <!-- /.card -->

                    </div>
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
