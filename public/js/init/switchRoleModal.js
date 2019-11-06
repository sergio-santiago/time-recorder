$('.switch-role-modal-js').on('click', (event) => {
    let button = $(event.target);

    let userId = button.data('user-id');
    $('#switch_role_modal_user_id').val(userId);

    let isAdmin = button.data('is-admin');
    $('#switch_role_modal_is_admin').prop("checked", isAdmin);
});
