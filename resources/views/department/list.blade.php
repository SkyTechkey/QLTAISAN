

@extends('layouts.index')

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
          @can('create_content', App\Models\User::class)
            <div class="float-right col-1">
            <a href="{{route('department.create')}}"><button type="button" class="btn btn-block btn-success">Add</button></a>
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
                    <td class="row">
                        @can('update_department', App\Models\User::class)
                        <a href="{{route('department.edit',['department'=>$department->id])}}"><button type="button" class="btn btn-block btn-primary">Edit</button></a>
                        @endcan
                        @can('delete_department', App\Models\User::class)
                        <form method="POST" action={{route('department.destroy',['department'=>$department->id])}}>
                          @method('delete')
                          @csrf
                              <button type="submit" class="btn btn-block btn-danger">Delete</button>
                        
                      </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Department Code</th>
                <th>Name</th>
                <th>Note</th>
                <th>Number of employee</th>
                <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
</div>
@endsection
@push('content')
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
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