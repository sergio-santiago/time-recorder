$('.remove-user-modal-js').on('click', (event) => {
    let button = $(event.target);

    let userId = button.data('user-id');
    $('#remove_user_modal_user_id').val(userId);
});
