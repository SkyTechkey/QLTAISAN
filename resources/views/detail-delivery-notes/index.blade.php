@extends('layouts.master')
<!-- Title content -->
@section('title')
    Chi tiết phiếu
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
                    <h1>Chi tiết phiếu nhập</h1>
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
                    <h4 class="modal-title">Thêm chi tiết</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  method="POST" action={{route('detail-delivery-note.store')}} enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-sm-4">
                            <input type="text" name="PX_id" class="form-control" value="{{$note_id}}" hidden>
                        </div>
                        <div class="row my-3">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Chọn tài sản</label>
                                <select id="" name="asset_id" class="form-control select2bs4" style="width: 100%;">
                                    <option value="1" selected="selected">Chọn tài sản</option>
                                    @foreach ($assets as $asset)
                                        <option value="{{$asset->id}}">{{$asset->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="number" name="amount" class="form-control" id="exampleInputEmail1" placeholder="Số lượng" >
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="exampleInputEmail1">Đơn giá</label>
                                <input type="number" name="unit_price" class="form-control" id="exampleInputEmail1" placeholder="Đơn giá" >
                            </div>
                        </div>
    
                        <div class="form-group my-3">
                            <label>Ghi chú</label>
                            <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ..."></textarea>
                        </div>
                       
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                        <div class="form-group my-3 row">
                            <label>* Nếu chưa có tài sản có thể thêm tài sản ở đây&nbsp;</label>
                            <form  method="POST" action={{route('assets.create')}} enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="detail_id" class="form-control" value={{$note_id}} hidden>
                                <input type="text" name="detail_type" class="form-control" value="delivery" hidden>
                                <button type="submit" class="btn btn-outline-success btn-sm">thêm</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    
                
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                    </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tên tài sản</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_assets">
                                @foreach ($details as $detail)
                                <tr>
                                    <td> {{$detail->asset->name }}</td>
                                    <td> {{$detail->amount}}</td>
                                    <td> {{$detail->unit_price}}</td>
                                    <td> {{$detail->total}}</td>

                                    <td>
                                        <div class="row">
                                            @can('update_assets', User::class)
                                                <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                style="margin-left: 2px"
                                                    data-toggle="modal" data-target="#editAsset{{$detail->id}}">Sửa</button>
                                            @endcan
                                            @can('delete_assets', User::class)
                                                <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                    style="margin-left: 2px" data-toggle="modal"
                                                    data-target="#deleteAsset{{$detail->id}}">xóa</button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>


                                {{-- Modal Edit User Start --}}
                                <div class="modal fade" id="editAsset{{ $detail->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Sửa chi tiết</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form  method="POST" action={{route('detail-delivery-note.update',$detail->id)}} enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="card-body">
                                                            <div class="form-group col-sm-4">
                                                                <input type="text" name="PX_id" class="form-control" value="{{$note_id}}" hidden>
                                                            </div>
                                                            <div class="row my-3">
                                                                <div class="col-sm-4">
                                                                    <label for="exampleInputEmail1">Chọn tài sản</label>
                                                                    <select id="" name="asset_id" class="form-control select2bs4" style="width: 100%;">
                                                                
                                                                        @foreach ($assets as $asset)
                                                                            <option value="{{$asset->id}}" 
                                                                                {{$asset->id == $detail->asset_id ? 'selected="selected"' : ''}}
                                                                                >{{$asset->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-4">
                                                                    <label for="exampleInputEmail1">Số lượng</label>
                                                                    <input type="number" name="amount" class="form-control" id="exampleInputEmail1" placeholder="Số lượng" value="{{$detail->amount}}">
                                                                </div>
                                                                <div class="form-group col-sm-4">
                                                                    <label for="exampleInputEmail1">Đơn giá</label>
                                                                    <input type="number" name="unit_price" class="form-control" id="exampleInputEmail1" placeholder="Đơn giá" value="{{$detail->unit_price}}">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="form-group my-3">
                                                                <label>Ghi chú</label>
                                                                <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ...">{{$detail->note}}</textarea>
                                                            </div>
                                                
                                                            <!-- /.card-body -->
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Thêm</button>
                                                            </div>
                                                        </form>
                                                        <div class="form-group my-3 row">
                                                            <label>* Nếu chưa có tài sản có thể thêm tài sản ở đây&nbsp;</label>
                                                            <form  method="POST" action={{route('assets.create')}} enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="text" name="detail_id" class="form-control" value={{$note_id}} hidden>
                                                                <input type="text" name="detail_type" class="form-control" value="delivery" hidden>
                                                                <button type="submit" class="btn btn-outline-success btn-sm">thêm</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                {{-- Modal Edit User End --}}

                                {{-- Modal Lock/Unlock User Start --}}
                                <div class="modal fade" id="deleteAsset{{ $detail->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <form action="{{route('detail-delivery-note.destroy',$detail->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Xác nhận xóa ?</h4>
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
                                                    <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal" data-target="#editUser${res[i].id}">Sửa</a>
                                                @endcan

                                                @can('delete_user', User::class)
                                                    <a href="#" class="col-5 btn bg-gradient-danger btn-sm" style="margin-left: 10px" data-toggle="modal"
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
