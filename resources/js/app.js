
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {
    $(document).on('click', '.lottery-button',function(e) {
        e.preventDefault();
        $('#body-preloader').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: '/lottery/prize',
            error: function() {
                $('.lottery-heading').text('Something went wrong! Please reload a page and try once more');
            },
            success: function(result) {
                var modalBody = $('#lottery-modal').find('.modal-body');

                $(modalBody).html('<h3>Your prize is ' +
                    (result.win_quantity === 1) ? '' : '<b>' + win_quantity + '</b> ' +
                    result.win_type + '</h3>');

                if(result.gift_type) {
                    $('.convert').removeClass('hidden')
                }
                $('#lottery-modal').modal('show');
            }
        }).done(function () {
            $('#body-preloader').css('display', 'none');
        });
    });
    $(document).on('click', '.lottery-button',function(e) {
        e.preventDefault();
        $('#body-preloader').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: '/lottery/prize',
            error: function() {
                $('.lottery-heading').text('Something went wrong! Please reload a page and try once more');
            },
            success: function(result) {
                var modalBody = $('#lottery-modal').find('.modal-body');

                $(modalBody).html('<h3>Your prize is ' +
                (result.win_quantity === 1) ? '' : '<b>' + win_quantity + '</b> ' +
                    result.win_type + '</h3>');

                if(result.gift_type) {
                    $('.convert').removeClass('hidden')
                }
                $('#lottery-modal').modal('show');
            }
        }).done(function () {
            $('#body-preloader').css('display', 'none');
        });
    });

});
