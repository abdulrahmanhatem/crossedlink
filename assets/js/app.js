/* Theme Name: Cross Link - Responsive Landing Page Template
   Author: Themesdesign
   Version: 1.0.0
   File Description: Main JS file of the template
*/

$(document).ready(function(){

    
    

    $('#select-category-selectized, input[name="first_name"], input[name="middle_name"],  input[type="search"]').on("input change paste", function() {
        var newVal = $(this).val().replace(/[^a-zA-Z\s\u0600-\u06FF]/g , '');
        $(this).val(newVal);
    });

    $('input[name="phone"], input[name="phone_number"]').on("input", function() {
        this.value = '+' + this.value.replace(/[\D]/g,'');
    });
    
    $('input[name="phone_no"]').on("input", function() {
        this.value = this.value.replace(/[\D]/g,'');
    });

    $('input[name="employers"], input[name="experience"]').on("input", function() {
        this.value = this.value.replace(/[\D]/g,'');
    });

});

(function ($) {

    'use strict';

    // Loader 
    
    $(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({
            'overflow': 'visible'
        });
        
        var selectized = $('#select-category').selectize();
        selectized[0].selectize.focus();
    }); 

    // Selectize
    $('#select-category, #select-lang,#select-country').selectize({
        create: false,
        sortField: {
            field: 'text',
            direction: 'asc'
        },
        dropdownParent: 'body'
    });

    // Checkbox all select
    $("#customCheckAll").click(function() {
        $(".all-select").prop('checked', $(this).prop('checked'));
    });

    // Nice Select
    $('.nice-select').niceSelect();

    // Back to top
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    }); 
    $('.back-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 3000);
        return false;
    });


    $(window).resize(function() {
        var width = $(window).width();
        if (width < 767){
          $('.accordion .collapse.show').removeClass('show');
        }
    });

    if (window.matchMedia('(max-width: 767px)').matches) {
        $('.accordion .collapse.show').removeClass('show');
    }

})(jQuery)