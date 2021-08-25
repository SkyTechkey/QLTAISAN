@extends('layouts.master')
<!-- Title content -->
    @section('title')
        Permission
    @endsection
<!-- End Title -->

<!--Add Css -->
    @push('css-up')

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
                        <h1>Permission List</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            
            <div class="card-header">
                <h3 class="card-title">List of Permission</h3>
                @can('create_permission', App\Models\User::class)
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
                            <th>Permission name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <div class="btn-group">
                                    @can('update_permission', App\Models\User::class)
                                    <button type="button" class="btn btn-warning btn-block btn-flat"
                                        data-toggle="modal" data-target="#modal-edit{{ $permission->id }}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    @endcan
                                    @can('delete_permission', App\Models\User::class)
                                            <form method="POST" action={{ route('permission.destroy', $permission->id) }}>
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-block btn-flat"><i
                                                        class="nav-icon fas fa-trash-alt"></i></button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-edit{{ $permission->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Permission</h4>
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
                                                                action="{{ route('permission.update', $permission->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="name">permission name</label>
                                                                        <input type="name" name="name"
                                                                            class="form-control"
                                                                            placeholder="Enter name..." value="{{$permission->name}}">
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
                            <th>Permission name</th>
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
                    <h4 class="modal-title">Add New Permission</h4>
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
                                    <form method="POST" action="{{ route('permission.store') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Permission name</label>
                                                <input type="name" name="name" class="form-control" id="name"
                                                    placeholder="Enter name...">
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
