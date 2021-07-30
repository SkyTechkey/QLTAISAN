
@extends('layouts.index')

@section('content')
<div class="container ">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">General Form</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

        <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('content.update',['content'=>$content->id]) }}">
                @csrf
                @method('put')
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name='title' placeholder="title" value={{$content->title}}>
                </div>
               
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control" id="content" name='content' placeholder="content" value={{$content->content}}>
                  </div>
                  <div class="form-group">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" name='note' placeholder="note" value={{$content->note}}>
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
