$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: true,
    timer: 5000
});

Dropzone.options.dropzone = {
    maxFilesize: 1024,
    renameFile: function(file) {
        // name::note::privacy::content_id::typeFile
        var content_id = $("#content_id").val() ? $("#content_id").val() : null,
            name = $("#name").val() ? $("#name").val() + '.' + file.type.split('/').pop() : file.name,
            note = $("#note").val() ? $("#note").val() : null,
            privacy = $("#privacy").is(":checked"),
            type = file.type.split('/')[0],
            newName = `${name}${"::"}${note}${"::"}${privacy}${"::"}${content_id}::${type}`;
        return newName;
    },
    acceptedFiles: "image/*, video/*, audio/*",
    timeout: 5000000,
    success: function(file, res) {
        if (res.warning) {
            // alert warning
            Toast.fire({
                icon: 'warning',
                title: `${res.warning}`
            });
        }
        if (res.success === true) {
            // alert success
            Toast.fire({
                icon: 'success',
                title: 'File has successfully uploaded!'
            });
        }
    },
    error: function(file, res) {
        Toast.fire({
            icon: 'error',
            title: 'Something went wrong. Try again!'
        });
    }
};

// Copy File Path to Clipboard

const coppyPath = (id) => {
    const copyText = document.getElementById(`path-${id}`);
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    document.execCommand("copy");
}