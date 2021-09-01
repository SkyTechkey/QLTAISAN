@push('js-down')
<script src={{URL::asset("dist/js/demo.js")}}></script>
<script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('success') }}");
    @endif
    @if($errors->any())
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("Hành động thực hiện không thành công");
    @endif
    // @if(Session::has('fail'))
    // toastr.options =
    // {
    //     "closeButton" : true,
    //     "progressBar" : true
    // }
    //         toastr.error("{{ session('fail') }}");
    // @endif
</script>
@endpush