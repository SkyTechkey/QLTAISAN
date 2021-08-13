$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

Dropzone.options.dropzone = {
    maxFilesize: 1024,
    renameFile: function(file) {
        // name::note::privacy::content_id
        var content_id = $("#content_id").val() ? $("#content_id").val() : null,
            name = $("#name").val() ? $("#name").val() + '.' + file.type.split('/').pop() : file.name,
            note = $("#note").val() ? $("#note").val() : null,
            privacy = $("#privacy").is(":checked"),
            newName = `${name}${"::"}${note}${"::"}${privacy}${"::"}${content_id}`;
        return newName;
    },
    acceptedFiles: "image/*, video/*, audio/*",
    // addRemoveLinks: true,
    timeout: 5000000,
    // removedfile: function(file) {
    //     var name = file.upload.filename;
    //     $.ajax({
    //         type: "POST",
    //         url: '/delete',
    //         data: {
    //             filename: name
    //         },
    //         success: function(data) {
    //             console.log(data);
    //             console.log("File has been successfully removed!");
    //         },
    //         error: function(e) {
    //             console.log(e);
    //         }
    //     });

    //     var fileRef;
    //     return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file
    //         .previewElement) : void 0;
    // },
    success: function(file, res) {
        // console.log(res)
    },
    error: function(file, res) {
        // console.log(res);
        return false;
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