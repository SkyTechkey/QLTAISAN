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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @can('create_assets', User::class)

                            <li class="btn-file- "><a href="#"
                                   class="btn bg-gradient-success btn-sm"
                                   data-toggle="modal"
                                   data-target="#addAsset">Thêm mới</a></li>
                        @endcan
                    </ol>
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
                        <form method="POST" action={{ route('assets-detail.store') }} enctype="multipart/form-data">
                            @csrf
                            <div class="row my-3">
                                <div class="form-group col-sm-4">
                                    <label for="assets">Tài sản</label>
                                    <input type="text"
                                           class="form-control"
                                           id="assets"
                                           value="{{ Session::get('id_assets') }}"
                                           disabled>
                                    <input type="text"
                                           name="assets"
                                           class="form-control"
                                           value="{{ Session::get('id_assets') }}"
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
                                              placeholder="Ghi chú ..." required></textarea>
                                </div>
                            </div>
                            
                            <div>
                                <a type="button" href="{{ route('assets.index') }}"
                                        class="btn btn-default">Hủy</a>
                                <button type="submit"
                                        class="btn btn-primary float-right">Thêm</button>
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
