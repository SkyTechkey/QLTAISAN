@extends('layouts.master')
<!-- Title content -->
@section('title')
    Thông tin đơn vị
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-up')
<style>
    .css_button{
        margin: 4px 6px;
    }

    #custom-img {
        margin-top: 3rem;
        display: inline-block;
        width: 15rem;
        height: 15rem;
        object-fit: cover;
    }
</style>
@endpush
<!-- End Css -->

<!-- Body content -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin đơn vị</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <form method="POST" action={{ route('unit.update', $units->id) }}  enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="text-center" id="profile-img">
                                <img class="profile-user-img img-fluid img-circle" src={{$units->image ? $units->image: asset('/files/unit_avt/unit_avt.jpg')  }}
                                    id="custom-img" alt="User profile picture">
                                    </div>
                            </div>
                            <input type="file" id="input-file" name="file" style="visibility: hidden;" >
                            <label for='input-file' class="btn btn-primary btn-block" style="margin-top: 50px;" > Chọn file</label>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-5">
                                <div class="form-group row">
                                    <label for="organization_name" class="col-sm-3 col-form-label">Tên đơn vị</label>
                                    <div class="col-sm-9">
                                        <input type="text" id='or_name' name='name' class="form-control" required value="{{$units->name}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" id='address' name='address' class="form-control" required value="{{$units->address}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" id='email' name='email' class="form-control" required value="{{$units->email}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input type="text" id='phone' name='phone' class="form-control" value="{{$units->phone}}"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="representative" class="col-sm-3 col-form-label">Người đại diện</label>
                                    <div class="col-sm-9">
                                        <input type="text" id='representative' name='representative' class="form-control" value="{{$units->representative}}"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="position" class="col-sm-3 col-form-label">Chức vụ</label>
                                    <div class="col-sm-9">
                                        <input type="text" id='position' name='position' class="form-control" value="{{$units->position}}"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="note" class="col-sm-3 col-form-label">Ghi chú</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" id='note' name='note' class="form-control">{{$units->note}}</textarea>
                                    </div>
                                </div>
                                @can('update_unit', App\Models\User::class)
                                    <div class="row float-sm-right">
                                        <button type="submit" class="btn btn-primary css_button">Lưu</button>
                                    </div>
                                @endcan
                                
                            </form>
                        </div><!-- /.card-header -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
<!-- End body-->

@push('js-down')
    <script>
        const fileName = document.querySelector("#input-file");
        const img = document.querySelector("#profile-img img");
        
        fileName.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const result = reader.result;
                    img.src = result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush