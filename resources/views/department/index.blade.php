@extends('layouts.master')

    @section('title')
        Department
    @endsection
    @push('css-up')
    @endpush
    @push('js-up')
    @endpush

@section('content')

  <div class="container">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Department List</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <div class="card">

            <div class="card-header">
              <h3 class="card-title">List of Departments</h3>
              @can('create_department', App\Models\User::class)
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
                  <th>Department Code</th>
                  <th>Name</th>
                  <th>Note</th>
                  <th>Number of employee</th>
                  <th>Branch</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                    <tr>
                        <td>{{$department->department_code}}</td>
                        <td>{{$department->name}}</td>
                        <td>{{$department->note}}</td>
                        <td>{{count($department->user)}}</td>
                        <td>{{$department->branch->name}}</td>
                        <td class="row">
                          <div class="btn-group">
                            @can('update_department', App\Models\User::class)
                              <button type="button" class="btn btn-warning btn-block btn-flat"
                                data-toggle="modal" data-target="#modal-edit{{ $department->id }}">
                                <i class="fa fa-pencil-alt"></i>
                              </button>
                            @endcan
                            @can('delete_department', App\Models\User::class)
                              <form method="POST" action={{route('department.destroy',$department->id)}}>
                                @method('delete')
                                @csrf
                                  <button type="submit" class="btn btn-danger btn-block btn-flat">
                                    <i class="nav-icon fas fa-trash-alt"></i>
                                  </button>
                              </form>
                            @endcan
                          </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-edit{{$department->id}}">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title">Edit Department</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
            
                              <div class="modal-body">
                                  <!-- Main content -->
                                  <section class="content">
                                      <div class="container-fluid">
                                          <div class="row"> 
                                              <div class="col-md-12">
                                                  <form method="POST" action="{{ route('department.update',$department->id) }}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="department_code">Department Code</label>
                                                            <input type="text" class="form-control" id="department_code" name='department_code'
                                                                placeholder="department_code" value="{{$department->department_code}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Name Department</label>
                                                            <input type="text" class="form-control" id="name" name='name' placeholder="name" value="{{$department->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Note</label>
                                                            <textarea class="form-control" rows="3" name="note"
                                                                placeholder="Note ...">{{$department->note}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="branch_id">Branch</label>
                                                          <select class="custom-select" id="branch_id"
                                                              name="branch_id">
                                                              @foreach ($branches as $branch)
                                                                  <option value={{ $branch->id }}
                                                                    {{ $department->branch_id == $branch->id ? 'selected' : '' }}
                                                                    >{{ $branch->name }}</option>
                                                              @endforeach
                                                          </select>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                  </form>
                                              </div>
                                          </div>
                                      </div>
                                  </section>
                              </div>
                          </div>
                      </div>
                    </div>

                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Department Code</th>
                    <th>Name</th>
                    <th>Note</th>
                    <th>Number of employee</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="modal fade" id="modal-add">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Add New Department</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <!-- Main content -->
                      <section class="content">
                          <div class="container-fluid">
                              <div class="row"> 
                                  <div class="col-md-12">
                                      <form method="POST" action="{{ route('department.store') }}">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="department_code">Department Code</label>
                                                <input type="text" class="form-control" id="department_code" name='department_code'
                                                    placeholder="department_code">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name Department</label>
                                                <input type="text" class="form-control" id="name" name='name' placeholder="name">
                                            </div>
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea class="form-control" rows="3" name="note"
                                                    placeholder="Note ..."></textarea>
                                            </div>
                                            <div class="form-group">
                                              <label for="branch_id">Branch</label>
                                              <select class="custom-select" id="branch_id"
                                                  name="branch_id">
                                                  @foreach ($branches as $branch)
                                                      <option value={{ $branch->id }}>{{ $branch->name }}</option>
                                                  @endforeach
                                              </select>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </section>
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

    @endpush
<!-- End js -->
<!-- End Js -->
