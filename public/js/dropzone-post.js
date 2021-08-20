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
    autoProcessQueue:false,
    maxFilesize: 1024,
    init: function() {
            var submitButton = document.querySelector("#submit-all")
                dropzone = this; // closure
        
            submitButton.addEventListener("click", function() {
              dropzone.processQueue(); // Tell Dropzone to process all queued files.
            })
            this.on("addedfile", function(file) {
    
                // Create the remove button
                var removeButton = Dropzone.createElement('<a class="dz-remove">Remove file</a>');
                
        
                // Capture the Dropzone instance as closure.
                var _this = this;
        
                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                  // Make sure the button click doesn't submit the form:
                  e.preventDefault();
                  e.stopPropagation();
        
                  // Remove the file preview.
                  _this.removeFile(file);
                  // If you want to the delete the file on the server as well,
                  // you can do the AJAX request here.
                });
        
                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
              });
        },
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