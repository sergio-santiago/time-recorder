$('.show-time-record-commentary-modal-js').on('click', (event) => {
    let button = $(event.target);
    $('#show_time_record_commentary_render').html(button.data('comment'));
});
