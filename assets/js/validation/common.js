$(document).ready(function() {
    $(document).on('keydown',".numericOnly",function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $(document).on("keypress keyup blur",".decimalNumericOnly",function (event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if (event.which != 8 && (event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    $( document ).on('keydown',".txtOnly",function(e) {
        var key = e.keyCode;
        if ( (key >= 48 && key <= 57) || (key >= 96 && key <= 105) ) {
            e.preventDefault();
        }
    });
   
    $(document).on("keypress",".txtNoSpaces", function(e) {
        if (event.keyCode == 32) {

         event.preventDefault();
        }
    });
    
});