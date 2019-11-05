<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="removeUserModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('process-remove-user-form') }}">
                @csrf
                <input id="remove_user_modal_user_id" type="hidden" name="user_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeUserModalLabel">Remove user from company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to do it?</h4>
                    <hr>
                    <h5>Attention!</h5>
                    <ul>
                        <li>
                            If you delete the user <b>all time records associated with the user will also be will
                                erased</b>
                        </li>
                        <li>
                            The user's <b>invitation hash will be regenerated</b>
                        </li>
                        <li>
                            The user can access the platform but is not connected to the company or keep time records
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Remove user</button>
                </div>
            </form>
        </div>
    </div>
</div>
