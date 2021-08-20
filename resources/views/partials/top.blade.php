{{-- @extends('demo-test.demo-test')
@section('content') --}}
    <div class="btn-group">
        <form action="" method="">
            @csrf
            Nội dung:
            <input type="text" style="margin:0px 4px" id="content" name="content">
            Từ ngày:
            <input type="date" style="margin:0px 4px; width: 150px" id="from_date" name="from_date">
            Đến ngày:
            <input type="date" style="margin:0px 4px; width: 150px" id="to_date" name="to_date">

            <input type="hidden" value=" " id="type_id" name="type_id" >
        <button type="submit" class="btn btn-primary" style="width: 100px; margin-left: 14px;">Tìm</button>
        </form>
    </div> 
{{-- @endsection --}}
