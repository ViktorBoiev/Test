
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
                var modalBody = $('#lottery-modal').find('.modal-body')[0];
                $('#lottery-modal').attr('data-id', result.id);
                $('#count').html((result.win_quantity === 1) ? '' : '<b>' + result.win_quantity + '</b> ');
                $('#type').html((result.win_type === 'money') ? '$' : ((result.win_type === 'gift') ? result.gift_type : result.win_type));
                $(modalBody).append();

                if(result.win_type ==='money') {
                    $('.convert').removeClass('hidden')
                }
                $('#lottery-modal').modal('show');
            }
        }).done(function () {
            $('#body-preloader').css('display', 'none');
        });
    });
    $(document).on('click', '.decline',function(e) {
        e.preventDefault();
        $('#modal-preloader').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: '/lottery/prize/decline',
            data: {
                id: $('#lottery-modal').attr('data-id')
            }
        }).done(function () {
            $('#modal-preloader').css('display', 'none');
            $('#lottery-modal').modal('hide');
        });
    });

    $(document).on('click', '.convert',function(e) {
        e.preventDefault();
        $('#modal-preloader').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: '/lottery/prize/convert',
            data: {
                id: $('#lottery-modal').attr('data-id')
            }
        }).done(function () {
            $('#modal-preloader').css('display', 'none');
            $('#lottery-modal').modal('hide');
        });
    });

    $(document).on('click', '.accept',function(e) {
        e.preventDefault();
        $('#modal-preloader').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: '/lottery/prize/accept',
            data: {
                id: $('#lottery-modal').attr('data-id')
            }
        }).done(function () {
            $('#modal-preloader').css('display', 'none');
            $('#lottery-modal').modal('hide');
        });
    });

    $('#lottery-modal').on('hide.bs.modal', function() {
        $('#count').html('');
        $('#type').html('');
        $('#lottery-modal').attr('data-id', '');
        if (!$('.convert').hasClass('hidden')) {
            $('.convert').addClass('hidden')
        }
    })

});
