

@extends('layouts.index')

@section('content')
<div class="container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department create</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Department</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
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
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>

</div>
@endsection

