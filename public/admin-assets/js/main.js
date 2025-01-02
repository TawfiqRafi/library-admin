(function($){
    "use-strict"

    jQuery(document).ready(function(){

        $(document).on('click', '#nav-control', function() {
            $('main').toggleClass('mini-nav');
            // Toggle the icon based on the current state
            const iconElement = $('#nav-control i');
            if ($('main').hasClass('mini-nav')) {
                iconElement.removeClass('bx-chevron-left').addClass('bx-chevron-right');
            } else {
                iconElement.removeClass('bx-chevron-right').addClass('bx-chevron-left');
            }
            console.log($('#nav-control').html());
        });

        //active navigation class
        var current = location.href;

        $('.main-navigation ul li a').each(function () {
            const $this = $(this);
             if ($this.attr('href') === current) {
                $this.closest('.treeview').addClass('nav-open');
                $this.closest('.treeview-menu').show();
                $this.closest('li').addClass('active');
            }
        });

        //bootstrap datepicker
        if ($('.bs-datepicker').length > 0) {
            $('.bs-datepicker').datepicker({
                todayHighlight: true,
                format: "yyyy-mm-dd",
                autoclose: true
            });
        }

        //summernote
        if ($('.description_summernote').length > 0) {
            $('.description_summernote').summernote({
                placeholder: 'Write description',
                tabsize: 2,
                height: 250
            });
        }

    });

    jQuery(window).on('load', function() {

    });



}(jQuery))
