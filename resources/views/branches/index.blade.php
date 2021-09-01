@extends('layouts.master')
<!-- Title content -->
@section('title')
    Quản lý chi nhánh
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
                    <h1>Quản lý chi nhánh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="btn-file-custom"><a href="#" class="btn bg-gradient-primary btn-sm">Thêm file Excel</a></li>
                        @can('create_branch', App\Models\User::class)
                        <li class="btn-file-custom"><a href="#" class="btn bg-gradient-success btn-sm" data-toggle="modal" data-target="#addBranch">Thêm mới</a></li>
                            
                        @endcan
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="addBranch">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm chi nhánh</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action={{ route('branch.store') }}>
                    @csrf
                    <div style="padding: 20px 20px 0 20px;">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Tên chi nhánh</label>
                      <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Tên chi nhánh"
                       >
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                          >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                          <input type="text" name="phone" class="form-control" id="phone" placeholder="số điện thoại"
                         >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                          <input type="text" name="address" class="form-control" id="address" placeholder="địa chỉ"
                         >
                        </div>
                      </div>
                    <input type="text" hidden name="unit_id" value="1">
                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Ghi chú</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="note" id="inputExperience" placeholder="Ghi chú"></textarea>
                      </div>
                    </div>
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
                                    <th>ID Chi nhánh</th>
                                    <th>Tên Chi nhánh</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ghi Chú</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{$branch->id}}</td>
                                        <td>{{$branch->name}}</td>
                                        <td>{{$branch->email}}</td>
                                        <td>{{$branch->address}}</td>
                                        <td>{{$branch->phone}}</td>
                                        <td>{{$branch->note}}</td>
                                        <td>
                                            <div class="row">
                                                @can('update_branch', App\Models\User::class)
                                                <a href="#" class="col-5 btn bg-gradient-success btn-sm" data-toggle="modal" data-target="#editBranch{{$branch->id}}">Sửa</a>
                                                @endcan
                                                @can('delete_branch', App\Models\User::class)
                                                <a href="#" class="col-5 btn bg-gradient-danger btn-sm" style="margin-left: 10px" data-toggle="modal" data-target="#deleteBranch{{$branch->id}}">Xóa</a> 
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                              
                                 {{-- Modal Delete Branch Start --}}
                                 <div class="modal fade" id="deleteBranch{{$branch->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <form method="POST" action={{ route('branch.destroy', $branch->id) }}>
                                                @method('delete')
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xác nhận xóa chi nhánh {{$branch->name}}?</h4> {{-- Thay tên chi nhánh vào ... --}}
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-outline-light">Xóa</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- Modal Delete Branch End --}}
                                
                                {{-- Modal Edit Branch Start --}}
                                <div class="modal fade" id="editBranch{{$branch->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Sửa chi nhánh</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action={{ route('branch.update', $branch->id) }}>
                                                @method('put')
                                                @csrf
                                                <div style="padding: 20px 20px 0 20px;">
                                                <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Tên chi nhánh</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Tên chi nhánh"
                                                    value="{{$branch->name}}">
                                                  </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                      <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                                      value="{{$branch->email}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group row">
                                                    <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" name="phone" class="form-control" id="phone" placeholder="số điện thoại"
                                                      value="{{$branch->phone}}">
                                                    </div>
                                                  </div>
                                                  <div class="form-group row">
                                                    <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" name="address" class="form-control" id="address" placeholder="địa chỉ"
                                                      value="{{$branch->address}}">
                                                    </div>
                                                  </div>
                                                <input type="text" hidden name="unit_id" value="1">
                                                <div class="form-group row">
                                                  <label for="inputExperience" class="col-sm-2 col-form-label">Ghi chú</label>
                                                  <div class="col-sm-10">
                                                    <textarea class="form-control" name="note" id="inputExperience" placeholder="Ghi chú">{{$branch->note}}</textarea>
                                                  </div>
                                                </div>
                                                </div>
                                                  <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-primary">Sửa</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- Modal Edit Branch End --}}

                               
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
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
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
