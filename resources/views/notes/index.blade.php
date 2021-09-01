@extends('layouts.master')
<!-- Title content -->
@section('title')
    Phiếu bàn giao
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-up')
    {{-- CSS Table --}}
    <link rel="stylesheet"
          href={{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet"
          href={{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <!-- Select2 -->
    <link rel="stylesheet"
          href={{ URL::asset('plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet"
          href={{ URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
    <style>
        .btn-file-custom {
            margin: 0 5px;
        }

    </style>
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
                    <h1>Quản lý nhập xuất</h1>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-1 col-form-label">Chi nhánh</label>
                            <div class="col-3">
                                <select id="select_branch"
                                        class="form-control select2bs4"
                                        style="width: 100%;">
                                    <option value="0"
                                            selected="selected">Tất cả chi nhánh</option>
                                    {{-- @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs"
                                    id="custom-tabs-three-tab"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('receipt-note*') ? 'active' : '' }}"
                                           id="custom-tabs-three-home-tab"
                                           data-toggle="pill"
                                           href="#custom-tabs-three-home"
                                           role="tab"
                                           aria-controls="custom-tabs-three-home"
                                           aria-selected="true">Phiếu nhập</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('delivery-note*') ? 'active' : '' }}"
                                           id="custom-tabs-three-profile-tab"
                                           data-toggle="pill"
                                           href="#custom-tabs-three-profile"
                                           role="tab"
                                           aria-controls="custom-tabs-three-profile"
                                           aria-selected="false">Phiếu xuất</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content"
                                     id="custom-tabs-three-tabContent">
                                     {{-- Tag tài sản --}}
                                    <div class="tab-pane fade show active"
                                         id="custom-tabs-three-home"
                                         role="tabpanel"
                                         aria-labelledby="custom-tabs-three-home-tab">
                                        <div>
                                            <ol class="breadcrumb">
                                                @can('create_assets', User::class)
                                                    <li class="btn-file-custom"><a href="#"
                                                           class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                                                    </li>

                                                    <li class="btn-file"><a href="#"
                                                           class="btn bg-gradient-success btn-sm"
                                                           data-toggle="modal"
                                                           data-target="#addReceiptNote">Thêm mới</a></li>
                                                @endcan
                                            </ol>
                                        </div>
                                        <div>
                                            {{-- MODAL ADD RECEIPT NOTE --}}
                                            <div class="modal fade" id="addReceiptNote">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Thêm phiếu</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form  method="POST" action={{route('receipt-note.store')}} >
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row my-3">
                                                                    <div class="form-group col-sm-4">
                                                                        <label for="exampleInputEmail1">Mã phiếu</label>
                                                                        <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Mã tài sản">
                                                                    </div>
                                                                    <div class="form-group col-sm-4">
                                                                        <label for="exampleInputEmail1">Tên người gửi</label>
                                                                        <input type="text" name="deliver" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                                    </div>
                                                                    <div class="form-group col-sm-4">
                                                                        <label for="exampleInputEmail1">Chức vụ</label>
                                                                        <input type="text" name="position" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                                    </div>
                                                                </div>
                                                                <div class="row my-3">
                                                                    <div class="form-group col-sm-4">
                                                                        <label for="exampleInputEmail1">Địa điểm</label>
                                                                        <input type="text" name="location" class="form-control" id="exampleInputEmail1" placeholder="Mã tài sản">
                                                                    </div>
                                                                    <div class="form-group col-sm-4">
                                                                        <label for="exampleInputEmail1">Tên người nhận</label>
                                                                        <select id="select_receiver" name="user_id" class="form-control select2bs4" style="width: 100%;">
                                                                            <option value="2" selected="selected">Tên người nhận</option>
                                                                            @foreach ($users as $user)
                                                                                @if ($user->id != 1)
                                                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <div class="form-group col-sm-4">
                                                                        <label for="exampleInputEmail1">Ngày nhận</label>
                                                                        <input type="date" name="date" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group my-3">
                                                                    <label>Ghi chú</label>
                                                                    <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ..."></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Thêm</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{-- END MODAL ADD RECEIPT NOTE --}}
                                            <table id="example1" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Mã phiếu</th>
                                                        <th>Tên người gửi</th>
                                                        <th>Tên người nhận</th>
                                                        <th>Chức vụ</th>
                                                        <th>Địa điểm</th>
                                                        <th>Ngày nhập</th>
                                                        <th>Chức năng</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_assets">
                                                    @foreach ($notes_receipt as $note)
                                                    <tr>
                                                        <td> {{$note->code }}</td>
                                                        <td> {{$note->deliver}}</td>
                                                        <td> {{$note->user->name}}</td>
                                                        <td> {{$note->position}}</td>
                                                        <td> {{$note->location}}</td>
                                                        <td> {{$note->date}}</td>
                                                        <td>
                                                            <div class="row">
                                                                @can('update_assets', User::class)
                                                                    <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                                    style="margin-left: 2px"
                                                                        data-toggle="modal" data-target="#editReceiptNote{{$note->id}}">Sửa</button>
                                                                @endcan
                                                                @can('view_assets', User::class)
                                                                    <a type="button" class="col-4 btn bg-gradient-primary btn-sm"
                                                                    style="margin-left: 2px" href="{{ route('detail-receipt-note.show', $note->id) }}">Xem</a>
                                                                @endcan
                                                                @can('delete_assets', User::class)
                                                                    <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                        style="margin-left: 2px" data-toggle="modal"
                                                                        data-target="#deleteReceiptNote{{$note->id}}">xóa</button>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                    
                    
                                                    {{-- Modal Edit User Start --}}
                                                    <div class="modal fade" id="editReceiptNote{{ $note->id }}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Sửa phiếu</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form  method="POST" action={{route('receipt-note.update',$note->id)}} >
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="card-body">
                                                                        <div class="row my-3">
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="exampleInputEmail1">Mã phiếu</label>
                                                                                <input type="text" name="code" class="form-control"
                                                                                value="{{$note->code}}" id="exampleInputEmail1" placeholder="Mã phiếu">
                                                                            </div>
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="exampleInputEmail1">Tên người gửi</label>
                                                                                <input type="text" name="deliver" class="form-control"
                                                                                value="{{$note->deliver}}" id="exampleInputEmail1" placeholder="Tên người gửi" >
                                                                            </div>
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="exampleInputEmail1">Chức vụ</label>
                                                                                <input type="text" name="position" class="form-control"
                                                                                value="{{$note->position}}" id="exampleInputEmail1" placeholder="Chức vụ" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="row my-3">
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="exampleInputEmail1">Địa điểm</label>
                                                                                <input type="text" name="location" class="form-control"
                                                                                value="{{$note->location}}" id="exampleInputEmail1" placeholder="Địa điểm">
                                                                            </div>
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="exampleInputEmail1">Tên người nhận</label>
                                                                                <select id="select_receiver" name="user_id" class="form-control select2bs4" style="width: 100%;">
                                                                                        @foreach ($users as $user)
                                                                                            @if ($user->id != 1)
                                                                                                <option value="{{ $user->id }}"
                                                                                                    {{$user->id == $note->user_id ? 'selected="selected"' : ''}}
                                                                                                    >{{ $user->name }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="form-group col-sm-4">
                                                                                <label for="exampleInputEmail1">Ngày nhận</label>
                                                                                <input type="date" name="date" class="form-control"
                                                                                value="{{$note->date}}" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group my-3">
                                                                            <label>Ghi chú</label>
                                                                            <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ...">{{$note->note}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Sửa</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    {{-- Modal Edit User End --}}
                    
                    
                    
                                                    {{-- Modal Lock/Unlock User Start --}}
                                                    <div class="modal fade" id="deleteReceiptNote{{ $note->id}}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content bg-danger">
                                                                        <form action="{{route('receipt-note.destroy',$note->id)}}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Xác nhận xóa?</h4>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-outline-light"
                                                                                    data-dismiss="modal">Hủy</button>
                                                                                <button type="submit" class="btn btn-outline-light">Xóa</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                    {{-- Modal Lock/Unlock User End --}}
                                                    @endforeach
                                                 
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    {{-- tag phiếu xuất --}}
                                    <div class="tab-pane fade"
                                    id="custom-tabs-three-profile"
                                    role="tabpanel"
                                    aria-labelledby="custom-tabs-three-profile-tab">
                                   <div>
                                       <ol class="breadcrumb">
                                           @can('create_assets', User::class)
                                               <li class="btn-file-custom"><a href="#"
                                                      class="btn bg-gradient-primary btn-sm">Thêm file Excel</a>
                                               </li>

                                               <li class="btn-file"><a href="#"
                                                      class="btn bg-gradient-success btn-sm"
                                                      data-toggle="modal"
                                                      data-target="#addDeliverNote">Thêm mới</a></li>
                                           @endcan
                                       </ol>
                                   </div>
                                   <div>
                                       {{-- MODAL ADD RECEIPT NOTE --}}
                                       <div class="modal fade" id="addDeliverNote">
                                           <div class="modal-dialog modal-lg">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title">Thêm phiếu</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <form  method="POST" action={{route('delivery-note.store')}} >
                                                       @csrf
                                                       <div class="card-body">
                                                           <div class="row my-3">
                                                               <div class="form-group col-sm-4">
                                                                   <label for="exampleInputEmail1">Mã phiếu</label>
                                                                   <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Mã tài sản">
                                                               </div>
                                                               <div class="form-group col-sm-4">
                                                                   <label for="exampleInputEmail1">Tên người nhận</label>
                                                                   <input type="text" name="receiver" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                               </div>
                                                               <div class="form-group col-sm-4">
                                                                   <label for="exampleInputEmail1">Chức vụ</label>
                                                                   <input type="text" name="position" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                               </div>
                                                           </div>
                                                           <div class="row my-3">
                                                               <div class="form-group col-sm-4">
                                                                   <label for="exampleInputEmail1">Địa điểm</label>
                                                                   <input type="text" name="location" class="form-control" id="exampleInputEmail1" placeholder="Mã tài sản">
                                                               </div>
                                                               <div class="form-group col-sm-4">
                                                                   <label for="exampleInputEmail1">Tên người nhận</label>
                                                                   <select id="select_receiver" name="user_id" class="form-control select2bs4" style="width: 100%;">
                                                                       <option value="2" selected="selected">Tên người xuất</option>
                                                                       @foreach ($users as $user)
                                                                           @if ($user->id != 1)
                                                                               <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                           @endif
                                                                       @endforeach
                                                                   </select>
                                                               </div>
                                                               
                                                               <div class="form-group col-sm-4">
                                                                   <label for="exampleInputEmail1">Ngày nhận</label>
                                                                   <input type="date" name="date" class="form-control" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                               </div>
                                                           </div>
                                                           <div class="form-group my-3">
                                                               <label>Ghi chú</label>
                                                               <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ..."></textarea>
                                                           </div>
                                                       </div>
                                                       <!-- /.card-body -->
                                                       <div class="modal-footer justify-content-between">
                                                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                           <button type="submit" class="btn btn-primary">Thêm</button>
                                                       </div>
                                                   </form>
                                               </div>
                                           </div>
                                           <!-- /.modal-dialog -->
                                       </div>
                                       {{-- END MODAL ADD RECEIPT NOTE --}}
                                       <table id="example2" class="table table-bordered table-hover">
                                           <thead>
                                               <tr>
                                                   <th>Mã phiếu</th>
                                                   <th>Tên người nhận</th>
                                                   <th>Tên người gửi</th>
                                                   <th>Chức vụ</th>
                                                   <th>Địa điểm</th>
                                                   <th>Ngày nhập</th>
                                                   <th>Chức năng</th>
                                               </tr>
                                           </thead>
                                           <tbody id="tbl_assets">
                                               @foreach ($notes_delivery as $note)
                                               <tr>
                                                   <td> {{$note->code }}</td>
                                                   <td> {{$note->receiver}}</td>
                                                   <td> {{$note->user->name}}</td>
                                                   <td> {{$note->position}}</td>
                                                   <td> {{$note->location}}</td>
                                                   <td> {{$note->date}}</td>
                                                   <td>
                                                       <div class="row">
                                                           @can('update_assets', User::class)
                                                               <button type="button" class="col-3 btn bg-gradient-success btn-sm"
                                                               style="margin-left: 2px"
                                                                   data-toggle="modal" data-target="#editDeliveryNote{{$note->id}}">Sửa</button>
                                                           @endcan
                                                           @can('view_assets', User::class)
                                                               <a type="button" class="col-4 btn bg-gradient-primary btn-sm"
                                                               style="margin-left: 2px" href="{{ route('detail-delivery-note.show', $note->id) }}">Xem</a>
                                                           @endcan
                                                           @can('delete_assets', User::class)
                                                               <button type="button" class="col-4 btn bg-gradient-danger btn-sm"
                                                                   style="margin-left: 2px" data-toggle="modal"
                                                                   data-target="#deleteDeliverNote{{$note->id}}">xóa</button>
                                                           @endcan
                                                       </div>
                                                   </td>
                                               </tr>
               
               
                                               {{-- Modal Edit User Start --}}
                                               <div class="modal fade" id="editDeliveryNote{{ $note->id }}">
                                                   <div class="modal-dialog modal-lg">
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h4 class="modal-title">Sửa phiếu</h4>
                                                               <button type="button" class="close" data-dismiss="modal"
                                                                   aria-label="Close">
                                                                   <span aria-hidden="true">&times;</span>
                                                               </button>
                                                           </div>
                                                           <form  method="POST" action={{route('delivery-note.update',$note->id)}} >
                                                               @csrf
                                                               @method('put')
                                                               <div class="card-body">
                                                                   <div class="row my-3">
                                                                       <div class="form-group col-sm-4">
                                                                           <label for="exampleInputEmail1">Mã phiếu</label>
                                                                           <input type="text" name="code" class="form-control"
                                                                           value="{{$note->code}}" id="exampleInputEmail1" placeholder="Mã phiếu">
                                                                       </div>
                                                                       <div class="form-group col-sm-4">
                                                                           <label for="exampleInputEmail1">Tên người nhận</label>
                                                                           <input type="text" name="receiver" class="form-control"
                                                                           value="{{$note->receiver}}" id="exampleInputEmail1" placeholder="Tên người gửi" >
                                                                       </div>
                                                                       <div class="form-group col-sm-4">
                                                                           <label for="exampleInputEmail1">Chức vụ</label>
                                                                           <input type="text" name="position" class="form-control"
                                                                           value="{{$note->position}}" id="exampleInputEmail1" placeholder="Chức vụ" >
                                                                       </div>
                                                                   </div>
                                                                   <div class="row my-3">
                                                                       <div class="form-group col-sm-4">
                                                                           <label for="exampleInputEmail1">Địa điểm</label>
                                                                           <input type="text" name="location" class="form-control"
                                                                           value="{{$note->location}}" id="exampleInputEmail1" placeholder="Địa điểm">
                                                                       </div>
                                                                       <div class="form-group col-sm-4">
                                                                           <label for="exampleInputEmail1">Tên người xuất</label>
                                                                           <select id="select_receiver" name="user_id" class="form-control select2bs4" style="width: 100%;">
                                                                                   @foreach ($users as $user)
                                                                                       @if ($user->id != 1)
                                                                                           <option value="{{ $user->id }}"
                                                                                               {{$user->id == $note->user_id ? 'selected="selected"' : ''}}
                                                                                               >{{ $user->name }}</option>
                                                                                       @endif
                                                                                   @endforeach
                                                                           </select>
                                                                       </div>
                                                                       
                                                                       <div class="form-group col-sm-4">
                                                                           <label for="exampleInputEmail1">Ngày nhận</label>
                                                                           <input type="date" name="date" class="form-control"
                                                                           value="{{$note->date}}" id="exampleInputEmail1" placeholder="Tên tài sản" >
                                                                       </div>
                                                                   </div>
                                                                   <div class="form-group my-3">
                                                                       <label>Ghi chú</label>
                                                                       <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú ...">{{$note->note}}</textarea>
                                                                   </div>
                                                               </div>
                                                               <!-- /.card-body -->
                                                               <div class="modal-footer justify-content-between">
                                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                   <button type="submit" class="btn btn-primary">Sửa</button>
                                                               </div>
                                                           </form>
                                                       </div>
                                                       <!-- /.modal-content -->
                                                   </div>
                                                   <!-- /.modal-dialog -->
                                               </div>
                                               {{-- Modal Edit User End --}}
               
               
               
                                               {{-- Modal Lock/Unlock User Start --}}
                                               <div class="modal fade" id="deleteDeliverNote{{ $note->id}}">
                                                           <div class="modal-dialog">
                                                               <div class="modal-content bg-danger">
                                                                   <form action="{{route('delivery-note.destroy',$note->id)}}" method="POST">
                                                                       @csrf
                                                                       @method('DELETE')
                                                                       <div class="modal-header">
                                                                           <h4 class="modal-title">Xác nhận xóa?</h4>
                                                                           <button type="button" class="close" data-dismiss="modal"
                                                                               aria-label="Close">
                                                                               <span aria-hidden="true">&times;</span>
                                                                           </button>
                                                                       </div>
                                                                       <div class="modal-footer justify-content-between">
                                                                           <button type="button" class="btn btn-outline-light"
                                                                               data-dismiss="modal">Hủy</button>
                                                                           <button type="submit" class="btn btn-outline-light">Xóa</button>
                                                                       </div>
                                                                   </form>
                                                               </div>
                                                               <!-- /.modal-content -->
                                                           </div>
                                                           <!-- /.modal-dialog -->
                                                       </div>
                                               {{-- Modal Lock/Unlock User End --}}
                                               @endforeach
                                            
                                           </tbody>
                                       </table>
                                   </div>

                               </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

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
    {{-- JS table search --}}
    <script src={{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js') }}></script>
    <script src={{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script>
    <script src={{ URL::asset('plugins/jszip/jszip.min.js') }}></script>
    <!-- Select2 -->
    <script src={{ URL::asset('plugins/select2/js/select2.full.min.js') }}></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });

        $(document).ready(function() {
            // Branch Change
            $('#select_branch').change(function() {
                // Branch id
                var id = $(this).val();
                // Set Empty the table
                $('#tbl_user').find('tr').remove();
                // AJAX request 
                $.ajax({
                    url: 'get-user/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(res) {
                        var len = 0;
                        if (res != null) {
                            len = res.length;
                        }

                        if (len > 0) {
                            // Read data and create <tr>
                            for (var i = 0; i < len; i++) {
                                var row = `<tr>
                                        <td>${res[i].id}</td>
                                        <td>${res[i].name}</td>
                                        <td>${res[i].username}</td>
                                        <td>${res[i].department_name}</td>
                                        <td>${res[i].status ? "Active" : "Lock"}</td>
                                        <td>${res[i].note ? res[i].id : ""}</td>
                                        <td>
                                            <div class="row">
                                                @can('update_user', User::class)
                                                    <a href="#"
                                                       class="col-5 btn bg-gradient-success btn-sm"
                                                       data-toggle="modal"
                                                       data-target="#editUser${res[i].id}">Sửa</a>
                                                @endcan

                                                @can('delete_user', User::class)
                                                    <a href="#"
                                                       class="col-5 btn bg-gradient-danger btn-sm"
                                                       style="margin-left: 10px"
                                                       data-toggle="modal"
                                                       data-target="#lockUser${res[i].id}">${res[i].status ? "Khóa" : "Mở khóa"}</a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>`;
                                $("#tbl_user").append(row);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
<!-- End js -->
<!-- End Js -->
