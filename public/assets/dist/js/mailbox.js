$(function() {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function() {
        var clicks = $(this).data('clicks')
        if (clicks) {
            //Uncheck all checkboxes
            $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function(e) {
        e.preventDefault()
            //detect type
        var $this = $(this).find('a > i')
        var fa = $this.hasClass('fa')

        //Switch states
        if (fa) {
            $this.toggleClass('fa-star')
            $this.toggleClass('fa-star-o')
        }
    })
})


$(function() {
    //Add text editor
    $('#compose-textarea').summernote()
})