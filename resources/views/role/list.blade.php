@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="container">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Roles List</h1>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card">
                
                <div class="card-header">
                    <h3 class="card-title">List of Roles</h3>
                    @can('is-admin', App\Models\User::class)
                        <div class="float-right col-1">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">
                                Add
                            </button>
                        </div>
                    @endcan
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Role name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                        @if ($permission->id >= 1 && $permission->id <= 5)
                                           <small class="badge badge-primary"> {{$permission ->name}}</small>
                                           
                                        @elseif ($permission->id >= 6 && $permission->id <= 10)
                                        <small class="badge badge-danger"> {{$permission ->name}}</small>
                                        @else
                                        <small class="badge badge-info"> {{$permission ->name}}</small>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                        @can('is-admin', App\Models\User::class)
                                        <button type="button" class="btn btn-warning btn-block btn-flat"
                                            data-toggle="modal" data-target="#modal-edit{{ $role->id }}">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                        @endcan
                                        @can('is-admin', App\Models\User::class)
                                                <form method="POST" action={{ route('role.destroy', ['role' => $role->id]) }}>
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-block btn-flat"><i
                                                            class="nav-icon fas fa-trash-alt"></i></button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-edit{{ $role->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Role</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Main content -->
                                                <section class="content">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <!-- left column -->
                                                            <div class="col-md-12">
                                                                <!-- jquery validation -->

                                                                <!-- /.card-header -->
                                                                <!-- form start -->
                                                                <form method="POST"
                                                                    action="{{ route('role.update', ['role' => $role->id]) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label for="name">Role name</label>
                                                                            <input type="name" name="name"
                                                                                class="form-control" id="name"
                                                                                placeholder="Enter name..." value="{{$role->name}}">
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            @foreach ($permissions as $permission)
                                                                            <div class="form-check col-md-6">
                                                                                <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permission_id[]"
                                                                                @foreach ($role->permissions as $r_per)
                                                                                    {{$r_per->id==$permission->id ? "checked":""}}
                                                                                @endforeach
                                                                                >
                                                                                <label class="form-check-label">{{$permission->name}}</label>
                                                                              </div>
                                                                        @endforeach
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                    <!-- /.card -->
                                                            </div>
                                                            <!--/.col (left) -->
                                                            <!-- right column -->
                                                            <div class="col-md-6">

                                                            </div>
                                                            <!--/.col (right) -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div><!-- /.container-fluid -->
                                                </section>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                        </form>
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Role name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="modal fade" id="modal-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-md-12">
                                        <!-- jquery validation -->

                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form method="POST" action="{{ route('role.store') }}">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">Role name</label>
                                                    <input type="name" name="name" class="form-control" id="name"
                                                        placeholder="Enter name...">
                                                </div>
                                                <div class="form-group row">
                                                    @foreach ($permissions as $permission)
                                                        <div class="col-md-6 custom-control custom-checkbox">
                                                            <input class="custom-control-input custom-control-input-danger"
                                                                type="checkbox" id="permission_id{{ $permission->id }}"
                                                                name="permission_id[]" value="{{ $permission->id }}">
                                                            <label for="permission_id{{ $permission->id }}"
                                                                class="custom-control-label">{{ $permission->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <!-- /.card -->
                                    </div>
                                    <!--/.col (left) -->
                                    <!-- right column -->
                                    <div class="col-md-6">

                                    </div>
                                    <!--/.col (right) -->
                                </div>
                                <!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </section>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
@endsection
@push('user')
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/dist/js/demo.js"></script>
    <script src="/plugins/toastr/toastr.min.js"></script>
    <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false
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
<script>
    $(function() {
      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultInfo').click(function() {
        toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultError').click(function() {
        toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultWarning').click(function() {
        toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
    });
  </script>
@endpush
