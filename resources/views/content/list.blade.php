

@extends('layouts.index')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @can('create_content', App\Models\User::class)
          <div class="col-1">
          <a href="{{route('content.create')}}"><button type="button" class="btn btn-block btn-success">Add</button></a>
          </div>
          @endcan
          <table id="example1" class="table table-bordered table-striped">
           
            <thead>
            <tr>
              <th>Titile</th>
              <th>Content</th>
              <th>Note</th>
              <th>Creator</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                <tr>
                    <td>{{$content->title}}</td>
                    <td>{{$content->content}}</td>
                    <td>{{$content->note}}</td>
                    <td>{{$content->user->name}}</td>
                    <td>{{$content->create_at}}</td>
                    <td class="row">
                        @can('update_content', App\Models\User::class)
                        <a href="{{route('content.edit',['content'=>$content->id])}}"><button type="button" class="btn btn-block btn-primary">Edit</button></a>
                        @endcan
                        @can('delete_content', App\Models\User::class)
                        <a href="{{route('content.destroy',['content'=>1])}}"><button type="button" class="btn btn-block btn-danger">Delete</button></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Titile</th>
                <th>Content</th>
                <th>Note</th>
                <th>Creator</th>
                <th>Created at</th>
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