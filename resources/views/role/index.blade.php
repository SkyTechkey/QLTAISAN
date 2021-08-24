@extends('layouts.master')
<!-- Title content -->
    @section('title')
        Roles
    @endsection
<!-- End Title -->

<!--Add Css -->
    @push('css-role')

    @endpush
<!-- End Css -->

<!--Add js -->
    @push('js-role')

    @endpush
<!-- End js -->

<!-- Body content -->
@section('content')

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
            <table id="example1" class="table table-bordered table-hover">
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
                                    @can('update_role', App\Models\User::class)
                                    @if ($role->name != "admin")
                                        <button type="button" class="btn btn-warning btn-block btn-flat"
                                            data-toggle="modal" data-target="#modal-edit{{ $role->id }}">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                    @endif
                                       
                                    @endcan
                                    @can('delete_role', App\Models\User::class)
                                        @if ($role->name != "admin")
                                            <form method="POST" action={{ route('role.destroy',$role->id) }}>
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-block btn-flat"><i
                                                        class="nav-icon fas fa-trash-alt"></i></button>
                                            </form>
                                        @endif
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
                                                        <form method="POST"
                                                            action={{route('role.update', $role->id)}}>
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
                                                                        <input class="form-check-input" type="checkbox" value={{ $permission->id }} name="permission_id[]"
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


@endsection
<!-- End body-->

<!--Add Css -->
    @push('css-down')

    @endpush
<!-- End Css -->

<!--Add js -->
    @push('js-down')

    @endpush
<!-- End js -->
<!-- End Js -->
