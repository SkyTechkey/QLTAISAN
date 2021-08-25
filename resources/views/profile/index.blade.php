@extends('layouts.master')
<!-- Title content -->
@section('title')
    Profile
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-up')
    <style>
        .css_button {
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
                    <h1>Thông tin nhân viên</h1>
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
           
                <form method="POST" action={{ route('profile.update', $user->id) }} enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center" id="profile-img">
                                        <img class="profile-user-img img-fluid img-circle" src={{$user->image ? $user->image : asset('/files/user_avt/user-avt.png')  }}
                                            id="custom-img" alt="User profile picture">
                                    </div>
                                    <input type="file" id="input-file" name="file" style="visibility: hidden;">
                                    <label for='input-file' class="btn btn-primary btn-block" style="margin-top: 50px;">
                                        Chọn file</label>
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
                                        <label for="name" class="col-sm-3 col-form-label">Họ và tên</label>
                                        <div class="col-sm-9">
                                            <input type="text" id='name' name='name' class="form-control"
                                                value="{{ $user->name }}" placeholder="Họ và tên">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Địa chỉ</label>
                                        <div class="col-sm-9">
                                            <input type="text" id='address' name='address' class="form-control"
                                                value="{{ $user->address }}" placeholder="Địa chỉ">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" id='email' name='email' class="form-control"
                                                value="{{ $user->email }}" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                        <div class="col-sm-9">
                                            <input type="text" id='phone' name='phone' class="form-control"
                                                value="{{ $user->phone }}" placeholder="Số điện thoại">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Mật khẩu</label>
                                        <div class="col-sm-9">
                                            <input type="password" id='password' name='password' class="form-control"
                                                placeholder="Mật khẩu">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="note" class="col-sm-3 col-form-label">Ghi chú</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" id='note' name='note' class="form-control"
                                                placeholder="Ghi chú">{{ $user->note }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row float-sm-right">
                                        <button type="submit" class="btn btn-primary css_button">Lưu</button>
                                    </div>
                                </div><!-- /.card-header -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
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