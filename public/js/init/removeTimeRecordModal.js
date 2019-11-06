$('.remove-time-record-modal-js').on('click', (event) => {
    let button = $(event.target);

    let timeRecordId = button.data('time-record-id');
    $('#remove_time_record_modal_id').val(timeRecordId);
});
